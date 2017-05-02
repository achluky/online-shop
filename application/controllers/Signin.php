<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	public $session_data;

	function __construct(){
		parent:: __construct();
		$this->session_data = $this->session->userdata('logged_in');
		if(count($this->session->userdata('logged_in'))){
			if(isset($this->session_data['level'])){
				if($this->session_data['level']=="admin"){
					redirect('admin/pesanan','refresh');	
				}elseif($this->session_data['level']=="pelanggan"){
					redirect(URL_,'refresh');	
				}
			}
		}
		$this->load->model('Model_User');
	}

	public function index(){
		//$this->data['sesi'] = $this->
		$this->load->view('view_login');
	}

	public function auth(){
		$user = $this->Model_User->cekLogin($_POST['username'],$_POST['password']);
		if($user!=NULL){
			if($user->level == "admin"){
				$session_array = array(
					'username' => $user->username,
					'level' => $user->level,
					'nama' => 'Admin'
				);
				$this->session->set_userdata('logged_in',$session_array);
				redirect('admin/pesanan','refresh');
			}else{
				redirect(SELF,'refresh');
			}
		}else{
			redirect('signin','refresh');
		}
	}

	public function cek(){
		$user = $this->Model_User->cekPelanggan($_POST['email'],$_POST['password']);
		if($user!=NULL){
			$session_array = array(
				'username' => $user->email_pelanggan,
				'level' => "pelanggan",
				'nama' => $user->nama
			);
			$this->session->set_userdata('logged_in',$session_array);
			redirect(URL_,'refresh');
		}else{
			redirect(URL_,'refresh');
		}
	}
}