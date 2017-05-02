<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Barang extends CI_Model{
	public $table = array("tbl_kategori","tbl_barang");

	public $column = array(
		"tbl_barang.kode_barang",
		"tbl_barang.kode_barang",
		"tbl_barang.nama_barang",
		"tbl_kategori.nama_kategori",
		"tbl_barang.harga",
		"tbl_barang.stok",
		"tbl_barang.keterangan",
		"tbl_barang.foto",
		"tbl_kategori.kode_kategori"
	);
	public $order = array('tbl_barang.nama_barang' => 'DESC');
	function __construct(){
		parent::__construct();
	}

	public function getAll(){
		$this->db->select($this->column);
		$this->db->join($this->table[0], $this->table[1].".kode_kategori = ".$this->table[0].".kode_kategori");
		$this->db->from($this->table[1]);
		$query = $this->db->get();
		return $query;	
	}

	public function get($data=null){
		$this->db->select($this->column);
		$this->db->join($this->table[0], $this->table[1].".kode_kategori = ".$this->table[0].".kode_kategori");
		$this->db->where("".$this->table[1].".stok > 0 ");
		if($data!=null){ 
			$this->db->where_in("kode_barang",$data);
		}
		$this->db->from($this->table[1]);
		$query = $this->db->get();
		return $query;
	}

	public function getEdit($data=null){
		$this->db->select($this->column);
		$this->db->join($this->table[0], $this->table[1].".kode_kategori = ".$this->table[0].".kode_kategori");
		if($data!=null){ 
			$this->db->where("kode_barang",$data);
		}
		$this->db->from($this->table[1]);
		$query = $this->db->get();
		return $query;	
	}

	public function input($data){
		return $this->db->insert('tbl_barang', $data);
	}

	public function update($data,$id){
		if($data['foto']==null || $data['foto']==""){
			unset($data['foto']);
		}
		$this->db->where('kode_barang', $id);
		return $this->db->update('tbl_barang',$data);
	}

	public function delete($id){
		$this->db->where('kode_barang', $id);
		return $this->db->delete('tbl_barang');
	}

	public function getJson($start, $end, $search){
		$this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}

	public function _get_datatables_query($start=null, $end=null, $search=null){
		$this->db->select($this->column);
		$this->db->join($this->table[0], $this->table[1].".kode_kategori = ".$this->table[0].".kode_kategori");
		$this->db->from($this->table[1]);

		$i = 0;
        foreach ($this->column as $item) {
            if($_POST['search']['value']){
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            	$column[$i] = $item;
            	$i++;
            }
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

	public function count_all(){
		$this->db->select('*');
		$this->db->from($this->table[1]);
		return $this->db->count_all_results();
	}

	public function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
}