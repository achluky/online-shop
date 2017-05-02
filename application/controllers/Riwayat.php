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
	}

	public function index(){
		if($this->is_pelanggan){
			redirect('pemesanan','refresh');
		}else{
			redirect(URL_,'refresh');
		}
	}
	public function pemesanan(){
		$this->data['session_data'] = $this->session_data;
		$this->data['is_pelanggan'] = $this->is_pelanggan;
		$this->load->model('admin/Model_Barang');
		$this->load->model('admin/Model_Kategori');
		$this->data['barang'] = $this->Model_Barang->get();
		$this->data['kategori'] = $this->Model_Kategori->get();
		$this->load->view('pemesanan/view_riwayat_pemesanan',$this->data);
	}

}

?>