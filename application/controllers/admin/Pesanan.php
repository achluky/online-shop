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
	}

	public function index(){
		$this->data['menu']['label'] = "pesanan";
        $this->data['pemesanan'] = $this->Model_Pesanan->get();
        //$this->data['detail'] = $this->Model_Pesanan->getDetail();
		$this->load->view('admin/pesanan/view_pesanan', $this->data);
	}

	public function dataJson(){
		
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $search = $this->input->get('search');
        $list = $this->Model_Pesanan->getJSON($start, $end, $search);

        $data = array();

        $no = $_POST['start'];
        foreach ($list as $dt) {
            $row = array();
            $row[] = ++$no;
            $row[] = "<a class='btn btn-success' data-toggle='modal' href='#kirim_".$dt->kode_pemesanan."'>Kirim</a>
                      <a class='btn btn-danger' data-toggle='modal' href='#batal_".$dt->kode_pemesanan."'>Batal</a>
                      <a class='btn btn-info' onClick='detail('$dt->kode_pemesanan');' data-toggle='modal' href='#detail_".$dt->kode_pemesanan."'>Detail</a>"; 
            $row[] = $dt->kode_pemesanan;
            $row[] = $dt->nama;
            $row[] = $dt->no_telp;
            $row[] = $dt->email_pelanggan;
            $row[] = number_format($dt->total_bayar);
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

}

?>