<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public $session_data;
	function __construct(){
		parent::__construct();
		$this->session_data = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in') || $this->session_data['level']!="admin"){
			redirect(URL_.'signin','refresh');
		}
		$this->data['menu'] = array(
            'parent'=>'kategori',
            'status' => 'active'
        );
	}

	function index(){
		$this->data['menu']['label'] = "kategori";
		$this->load->view('admin/kategori/view_kategori',$this->data);
	}

    public function input(){
        $this->load->model('admin/Model_Kategori');
        if(isset($_POST['input'])){
            $data = array(
                'kode_kategori' => $this->input->post('kode_kategori'),
                'nama_kategori' => $this->input->post('kategori')
            );
            if($this->Model_Kategori->input($data)){
                echo"<script>alert('Data Tersimpan !')</script>";
                redirect('admin/kategori','refresh');
            }else{
                echo"<script>alert('Gagal Tersimpan !')</script>";
            }
        }else{
            redirect('admin/kategori','refresh');
        }
    }

	public function dataJson(){
		$this->load->model('admin/Model_Kategori');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $search = $this->input->get('search');
        $list = $this->Model_Kategori->getJSON($start, $end, $search);

        $data = array();

        $no = $_POST['start'];
        foreach ($list as $dt) {
            $row = array();
            $row[] = ++$no; 
            $row[] = $dt->kode_kategori;
            $row[] = $dt->nama_kategori;
            $data[] = $row; 
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_Kategori->count_all(),
            "recordsFiltered" => $this->Model_Kategori->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
}