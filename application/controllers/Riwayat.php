<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {
	public $session_data;
	public $is_pelanggan;
	function __construct(){
		parent::__construct();
		$this->session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in') && $this->session_data['level']!="admin"){
			$this->is_pelanggan = true;
		}else{
			$this->is_pelanggan = false;
		}
		$this->load->model('admin/Model_Kategori');
		$this->load->model('Model_Pemesanan');
	}

	public function index(){
		if($this->is_pelanggan){
			redirect('pemesanan','refresh');
		}else{
			redirect(URL_,'refresh');
		}
	}

	public function pemesanan($id=null){
		if($this->is_pelanggan){

			$this->data['session_data'] = $this->session_data;
			$this->data['is_pelanggan'] = $this->is_pelanggan;
			$this->data['kategori'] = $this->Model_Kategori->get();

			if($id!=null || $id!=""){
				$this->data['detail'] = $this->Model_Pemesanan->getDetailPemesanan($id,$this->session_data);
				$this->load->view('pemesanan/view_detail_pemesanan',$this->data);
			}else{
				$this->data['pemesanan'] = $this->Model_Pemesanan->getPemesanan($this->session_data);
				$this->load->view('pemesanan/view_riwayat_pemesanan',$this->data);
			}
		}else{
			redirect(URL_,'refresh');
		}
	}

	public function konfirmasi(){
		if(isset($_POST['konfirmasi'])){
			$judul = $this->input->post('judul');
			$deskripsi = $this->input->post('deskripsi');
			$kode = $this->input->post('kode');
			$file_name = "";

            if($_FILES['foto']['size'] > 0){
                $file_name = md5(time());
                $this->load->library('upload');
                $config['upload_path']          = './img/konfirmasi';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')){
                    $this->load->helper('file');
                    $file_name .= $this->upload->file_ext;
                    $gbr = $this->upload->data();
                }else{
                    //echo"<script>alert('Upload gambar gagal !')</script>";
                }
            }else{
                //echo"<script>alert('Upload gambar gagal !')</script>";
            }

            $data = array(
            	'judul' => $judul,
            	'deskripsi' => $deskripsi,
            	'foto' => $file_name
            );

            if($this->Model_Pemesanan->konfirmasi($kode,$data,$this->session_data)){
            	echo"<script>alert('Data Tersimpan !')</script>";
                redirect(URL_.'riwayat/pemesanan','refresh');
            }else{
            	echo"<script>alert('Konfirmasi tidak valid !')</script>";
                //redirect(URL_.'riwayat/pemesanan','refresh');
            }
		}else{
			redirect(URL_,'refresh');
		}
	}

}

?>