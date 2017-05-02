<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_User extends CI_Model{
	public $table = "login";
	public $column = array(
		"login.username",
		"level_user.level"
	);
	
	function __construct(){
		parent::__construct();

	}
	
	public function get($email=null){
		$this->db->select("*");
		if($email!=null){ 
			$this->db->where('email_pelanggan', $email); 
		}
		$this->db->from('tbl_pelanggan');
		$query = $this->db->get();

		return $query;
	}

	public function cekLogin($user,$pass){
		
		$this->db->select($this->column);
		$this->db->join('level_user',$this->table.'.level = level_user.id');
		$this->db->where('username',$user);
		$this->db->where('password',md5($pass));
		$query = $this->db->get($this->table);

		return $query->row();
	}

	public function cekPelanggan($user,$pass){
		
		$this->db->select("*");
		$this->db->where('email_pelanggan',$user);
		$this->db->where('password',md5($pass));
		$query = $this->db->get('tbl_pelanggan');

		return $query->row();
	}
}
?>