<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
	public $session_data;
	public $is_pelanggan;
	function __construct(){
		parent::__construct();
		$this->session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in') && $this->session_data['level']!="admin"){
			$this->is_pelanggan = true;
		}else{
			$this->is_pelanggan = false;
			redirect(URL_,'refresh');
		}
		$this->data['menu'] = array(
            'parent'=>'barang',
            'status' => 'active'
        );
        $this->load->model('admin/Model_Barang');
		$this->load->model('admin/Model_Kategori');
		$this->load->model('Model_Registrasi');
		$this->load->model('Model_User');
	}

	public function index(){
		$this->data['session_data'] = $this->session_data;
		$this->data['is_pelanggan'] = $this->is_pelanggan;

		$this->data['provinsi'] = $this->Model_Registrasi->getProvinsi();
		$this->data['kategori'] = $this->Model_Kategori->get();
		$this->data['pelanggan'] = $this->Model_User->get($this->session_data['username']);

		if(isset($_POST['beli_banyak']) || isset($_POST['beli_satu'])) { 
			extract($_POST);
			$id_masakan = "";
			$jml_pesanan = count($pesanan);
			for($i=0; $i < count($pesanan); $i++){
			    if($i == 0){
			        $id_masakan = " id_masakan='$pesanan[$i]'";
			    }else{
			        $id_masakan .= " OR id_masakan='$pesanan[$i]'";
			    }
			}
			if($jml_pesanan > 0){
			    $empty = false;
			}else{
			    $empty = true;
			}
			$this->data['jml_pesanan'] = $jml_pesanan;
			$this->data['empty'] = $empty;
		}else{
			redirect(URL_,'refresh');
		}

		$this->data['barang'] = $this->Model_Barang->get($pesanan);
		$this->load->view('pemesanan/view_pemesanan',$this->data);
	}

	public function submit(){
		if(isset($_POST['data_pelanggan'])){
			$kode_pemesanan = "#".$this->input->post('provinsi').time().rand();
			$data = array(
				'kode_pemesanan' => $kode_pemesanan,
				'nama' => $this->input->post('provinsi'),
				'no_telp' => $this->input->post('no_telp'),
				'id_provinsi' => $this->input->post('provinsi'),
				'kota' => $this->input->post('kota'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_pos' => $this->input->post('kode_pos'),
				'detail_alamat' => $this->input->post('alamat')
			);
			$this->load->model('Model_Pemesanan');
			if($this->Model_Pemesanan->input($data)){
				$data_barang = array(array());
				extract($_POST);
				$total_bayar = 0;
				for($i=0; $i < count($kode_barang); $i++){
					$brg = $this->Model_Barang->get($kode_barang[$i]);
					$b = $brg->row();
					$total_bayar = $qty[$i]*$b->harga;
					$data_barang[$i]['kode_pemesanan'] = $kode_pemesanan;
					$data_barang[$i]['email_pelanggan'] = $this->session_data['username'];
					$data_barang[$i]['kode_barang'] = $kode_barang[$i];
					$data_barang[$i]['jml_pesanan'] = $qty[$i];
					$data_barang[$i]['total_bayar'] = $total_bayar;
				}
				if($this->Model_Pemesanan->inputDetail($data_barang)){
					echo "<script>alert('Data tersimpan, segerah lakukan pembayaran');</script>";
					redirect(URL_.'riwayat/pemesanan','refresh');
				}else{
					echo "<script>alert('Input detail gagal');</script>";
					redirect(URL_,'refresh');
				}
			}else{
				echo "<script>alert('Input detail gagal');</script>";
				redirect(URL_,'refresh');
			}
		}else{
			redirect(URL_,'refresh');
		}
	}

}

?>