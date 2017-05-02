<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {
	public $session_data;

	function __construct(){
		parent:: __construct();
		$this->session_data = $this->session->userdata('logged_in');
		if(count($this->session->userdata('logged_in'))){
			if(isset($this->session_data['level'])){
				redirect(URL_,'refresh');	
			}
		}
		$this->load->model('Model_Registrasi');
	}

	public function index(){
		$this->data['provinsi'] = $this->Model_Registrasi->getProvinsi();
		$this->load->view('registrasi/view_registrasi', $this->data);
	}

	public function input(){
        if(isset($_POST['input'])){
            $file_name = md5(time());

            $this->load->library('upload');
            $config['upload_path']          = 'img/pelanggan';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $config['file_name']            = $file_name;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')){
                $gbr = $this->upload->data();
                $data = array(
                    'email_pelanggan' => $this->input->post('email'),
                    'nama' => $this->input->post('nama'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'no_telp' => $this->input->post('no_telp'),
                    'id_provinsi' => $this->input->post('provinsi'),
                    'kota' => $this->input->post('kota'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kode_pos' => $this->input->post('kode_pos'),
                    'detail_alamat' => $this->input->post('alamat'),
                    'password' => md5($this->input->post('pass1')),
                    'foto' => $file_name.$this->upload->file_ext
                );
                if($this->Model_Registrasi->input($data)){
                    echo"<script>alert('Data Tersimpan !')</script>";
                    redirect(URL_,'refresh');
                }else{
                    echo"<script>alert('Gagal Tersimpan !')</script>";
                }
            }else{
                echo"<script>alert('Upload Gagal !')</script>";
            }
        }else{
            redirect(URL_,'refresh');
        }
    }

	

}