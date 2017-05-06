<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Pesanan extends CI_Model{
	public $table = array (
		"tbl_detail_pesanan",
		"tbl_pesanan",
		"tbl_barang",
		"tbl_kategori",
		"tbl_pelanggan"
	);

	public $column = array(
		"tbl_pesanan.kode_pemesanan",
		"tbl_pesanan.kode_pemesanan",
		"tbl_pelanggan.nama",
		"tbl_pelanggan.no_telp",
		"tbl_pelanggan.email_pelanggan",
		"tbl_pesanan.total_bayar",
		"tbl_pengiriman.waktu_pemesanan",
		"tbl_pengiriman.status"
	);
	
	public $order = array ('tbl_pengiriman.status="Menunggu"' => 'DESC'); 

	function __construct(){
		parent::__construct();
	}

	public function get(){
		$this->db->select($this->column);
		$this->db->from($this->table[1]);
		$this->db->join('tbl_pengiriman','tbl_pesanan.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
		$this->db->join($this->table[4], $this->table[1].'.email_pelanggan = '.$this->table[4].'.email_pelanggan','inner');
		$this->db->join($this->table[2], $this->table[1].'.kode_barang = '.$this->table[2].'.kode_barang','inner');
		$this->db->group_by($this->table[1].".kode_pemesanan");
		$this->db->order_by('tbl_pengiriman.waktu_pemesanan','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDetail($id=null){
		$this->db->select('*');
		$this->db->from('tbl_barang');
        $this->db->join($this->table[1], $this->table[0].'.id_pesanan = '.$this->table[1].'.id_pesanan');
		$this->db->join($this->table[4], $this->table[1].'.email_pelanggan = '.$this->table[4].'.email_pelanggan');
		$this->db->join($this->table[2], $this->table[1].'.kode_barang = '.$this->table[2].'.kode_barang');
		$this->db->where('tbl_detail_pesanan.kode_pemesanan',$id);
		$query = $this->db->get();
		return $query;
    }

	public function getJson($start=null, $end=null, $search=null){
		$this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}

	public function _get_datatables_query($start=null, $end=null, $search=null){
		$this->db->select($this->column);
		$this->db->from($this->table[1]);
		$this->db->join('tbl_pengiriman','tbl_pesanan.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
		$this->db->join($this->table[4], $this->table[1].'.email_pelanggan = '.$this->table[4].'.email_pelanggan','inner');
		$this->db->join($this->table[2], $this->table[1].'.kode_barang = '.$this->table[2].'.kode_barang','inner');
		$this->db->group_by($this->table[1].".kode_pemesanan");

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
		$this->db->distinct('kode_pemesanan');
		$this->db->from($this->table[1]);
		return $this->db->count_all_results();
	}

	public function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotal($kode=null){
    	$this->db->select('SUM(total_bayar) as total_bayar');
    	$this->db->from('tbl_pesanan');
    	$this->db->where('kode_pemesanan',$kode);
    	$query = $this->db->get();

    	return $query->row();
    }

    public function getKonfirmasi(){
    	$this->db->select('*');
    	$this->db->from('tbl_konfirmasi');
    	$this->db->join('tbl_pengiriman','tbl_konfirmasi.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
    	//$this->db->group_by('tbl_konfirmasi.kode_pemesanan');
    	$this->db->order_by('tbl_konfirmasi.id_konfirmasi','DESC');
    	$query = $this->db->get();

    	$array = array(array());
    	$i = 0;
    	foreach ($query->result() as $data) {
    		$this->db->select_max('id_konfirmasi');
    		$this->db->where('kode_pemesanan',$data->kode_pemesanan);
    		$q = $this->db->get('tbl_konfirmasi');
    		$id_konf = $q->row();

    		$array[$i]['id_konfirmasi'] = $id_konf->id_konfirmasi;
    		$array[$i]['kode_pemesanan'] = $data->kode_pemesanan;
    		$array[$i]['judul'] = $data->judul;
    		$array[$i]['deskripsi'] = $data->deskripsi;
    		$array[$i]['foto'] = $data->foto;
    		$array[$i]['waktu_konfirmasi'] = $data->waktu_konfirmasi;
    		
    		$i++;
    	}
    	return $query;
    }

    public function cekKonfirmasi($id=null){
	    $this->db->from('tbl_konfirmasi');
	    $this->db->join('tbl_pengiriman','tbl_konfirmasi.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
	    $this->db->where('tbl_konfirmasi.kode_pemesanan',$id);
	    return $this->db->count_all_results();
	}

	public function cekStatus($status=null,$id=null){
		$this->db->from('tbl_pengiriman');
	    $this->db->where('tbl_pengiriman.kode_pemesanan',$id);
	    $this->db->where('tbl_pengiriman.status',$status);
	    return $this->db->count_all_results();
	}

	public function updateStatus($status=null,$id=null){
		$data = array(
			'status' => $status
		);
		$this->db->where('kode_pemesanan',$id);
		$pengiriman = $this->db->update('tbl_pengiriman',$data);
		
		$this->db->where('kode_pemesanan',$id);
		$pesanan = $this->db->update('tbl_pesanan',$data);

		if($pengiriman && $pesanan){
			return true;
		}else{
			return false;
		}
	}

}