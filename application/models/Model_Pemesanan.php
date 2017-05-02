<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Pemesanan extends CI_Model{
	public $table = "tbl_pengiriman";

	function __construct(){
		parent::__construct();
	}

	public function input($data){
		return $this->db->insert($this->table, $data);
	}

}