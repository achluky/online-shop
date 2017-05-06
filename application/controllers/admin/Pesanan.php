<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
	public $session_data;
	function __construct(){
		parent::__construct();
		$this->session_data = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in') || $this->session_data['level']!="admin"){
			redirect(URL_.'signin','refresh');
		}
		$this->data['menu'] = array(
            'parent'=>'pesanan',
            'status' => 'active'
        );
        $this->load->model('admin/Model_Pesanan');
        $this->load->model('Model_Pemesanan');
	}

	public function index(){
		$this->data['menu']['label'] = "pesanan";
        $query = $this->Model_Pesanan->get();
        $this->data['pemesanan'] = $query;
        $this->data['konf'] = $this->Model_Pesanan->getKonfirmasi();
        //$this->data['detail'] = $this->Model_Pesanan->getDetail();
        $i=0;
        foreach ($query as $pemesan) {
            $d['kode'] = $pemesan->kode_pemesanan;
            $d['username'] = $pemesan->email_pelanggan;
            $q = $this->Model_Pemesanan->getDetailPemesanan($d['kode'], $d);
            $j=0;
            foreach ($q->result() as $dtl) {
                $tmp[$j++] = array(
                    'kode_barang' => $dtl->kode_barang,
                    'nama_kategori'  => $dtl->nama_kategori,
                    'nama_barang' => $dtl->nama_barang,
                    'harga' => $dtl->harga,
                    'foto' => $dtl->foto,
                    'jml_pesanan' => $dtl->jml_pesanan,
                    'total_bayar' => $dtl->total_bayar,
                    'kode_pemesanan' => $dtl->kode_pemesanan,
                    'nama' => $dtl->nama,
                    'no_telp' => $dtl->no_telp,
                    'provinsi' => $dtl->provinsi,
                    'kota' => $dtl->kota,
                    'kecamatan' => $dtl->kecamatan,
                    'kode_pos' => $dtl->kode_pos,
                    'detail_alamat' => $dtl->detail_alamat,
                    'waktu_pemesanan' => $dtl->waktu_pemesanan,
                    'status' => $dtl->status
                );
            }
            $detail_pemesanan[$i++] = $tmp;
        }

        $this->data['detail_pesanan'] = $detail_pemesanan;
		$this->load->view('admin/pesanan/view_pesanan', $this->data);
	}

	public function dataJson(){
		
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $search = $this->input->get('search');
        $list = $this->Model_Pesanan->getJSON($start, $end, $search);

        $data = array();

        $knfr = "";
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $row = array();
            $row[] = ++$no;
            $row[] = $dt->status;
            $k = "";
            $cek = $this->Model_Pesanan->cekKonfirmasi($dt->kode_pemesanan);
            if($cek > 0){
                $k = "<a class='btn btn-warning' data-toggle='modal' href='#konf_".$dt->kode_pemesanan."'>Konf</a>";
            }
            if($this->Model_Pesanan->cekStatus("Menunggu",$dt->kode_pemesanan)){
                $row[] = "$k
                          <a class='btn btn-danger' data-toggle='modal' href='#batal_".$dt->kode_pemesanan."'>Batal</a>
                          <a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 

            }elseif($this->Model_Pesanan->cekStatus("Terkirim",$dt->kode_pemesanan)){
                $row[] = "<a class='btn btn-danger' data-toggle='modal' href='#batal_".$dt->kode_pemesanan."'>Batal</a>
                          <a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 
            }elseif($this->Model_Pesanan->cekStatus("Batal",$dt->kode_pemesanan)){
                $row[] = "<a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 
            }elseif($this->Model_Pesanan->cekStatus("Terverifikasi",$dt->kode_pemesanan)){
                $row[] = "<a class='btn btn-success' data-toggle='modal' href='#kirim_".$dt->kode_pemesanan."'>Kirim</a>
                          <a class='btn btn-danger' data-toggle='modal' href='#batal_".$dt->kode_pemesanan."'>Batal</a>
                          <a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 
            }elseif($this->Model_Pesanan->cekStatus("Kadaluarsa",$dt->kode_pemesanan)){
                $row[] = "<a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 
            }
            $row[] = $dt->kode_pemesanan;
            $row[] = $dt->nama;
            $row[] = $dt->no_telp;
            $row[] = $dt->email_pelanggan;
            $total = $this->Model_Pesanan->getTotal($dt->kode_pemesanan);
            $row[] = "Rp. ".number_format($total->total_bayar);
            $row[] = $dt->waktu_pemesanan;
            $data[] = $row; 
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_Pesanan->count_all(),
            "recordsFiltered" => $this->Model_Pesanan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function verifikasi(){
        if(isset($_POST['verif'])){
            $id = $this->input->post('verif');
            if($this->Model_Pesanan->updateStatus("Terverifikasi",$id)){
                echo "<script>alert('Status pembayaran terverifikasi !')</script>";
                redirect(URL_.'admin/pesanan','refresh');
            }else{
                echo "<script>alert('Verifikasi gagal !')</script>";
            }
        }
    }

    public function kirim(){
        if(isset($_POST['kirim'])){
            $id = $this->input->post('kirim');
            if($this->Model_Pesanan->updateStatus("Terkirim",$id)){
                echo "<script>alert('Status pemesanan terkirim !')</script>";
                redirect(URL_.'admin/pesanan','refresh');
            }else{
                echo "<script>alert('Edit gagal !')</script>";
            }
        }
    }

    public function batal(){
        if(isset($_POST['batal'])){
            $id = $this->input->post('batal');
            if($this->Model_Pesanan->updateStatus("Batal",$id)){
                echo "<script>alert('Status pemesanan dibatalkan !')</script>";
                redirect(URL_.'admin/pesanan','refresh');
            }else{
                echo "<script>alert('Edit gagal !')</script>";
            }
        }
    }

}

?>