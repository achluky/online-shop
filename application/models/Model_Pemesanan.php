<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Pemesanan extends CI_Model{
	public $table = "tbl_pengiriman";

	function __construct(){
		parent::__construct();
	}

	//Input Data pengiriman
	public function input($data){
		return $this->db->insert($this->table, $data);
	}

	//Input detail pesanan
	public function inputDetail($data){
		return $this->db->insert_batch('tbl_pesanan', $data);
	}
}