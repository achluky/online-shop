<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Registrasi extends CI_Model{
	public $table = "tbl_pelanggan";

	function __construct(){
		parent::__construct();
	}

	public function input($data){
		return $this->db->insert($this->table, $data);
	}

	public function getProvinsi(){
		$this->db->select('*');
		$this->db->from('tbl_provinsi');
		$query = $this->db->get();

		return $query;
	}

}