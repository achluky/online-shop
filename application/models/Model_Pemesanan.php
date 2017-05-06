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

	public function getPemesanan($user){
		$email = $user['username'];
		$column = array(
			'tbl_pesanan.jml_pesanan',
			'tbl_pesanan.total_bayar'
		);

		$i=0;
		$kode = $this->getKodePemesanan($email);
		foreach ($kode->result() as $list) {
			$this->db->select($column);
			$this->db->from('tbl_pesanan');
			$this->db->join('tbl_pengiriman','tbl_pesanan.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
			$this->db->join('tbl_pelanggan','tbl_pesanan.email_pelanggan = tbl_pelanggan.email_pelanggan','inner');
			$this->db->join('tbl_barang','tbl_pesanan.kode_barang = tbl_barang.kode_barang','inner');
			$this->db->where('tbl_pesanan.email_pelanggan',$email);
			$this->db->where('tbl_pesanan.kode_pemesanan',$list->kode_pemesanan);
			$query = $this->db->get();
			
			$jml_bayar = 0;
			$jml_barang = 0;
			foreach ($query->result() as $data) {
				$jml_barang += $data->jml_pesanan;
				$jml_bayar += $data->total_bayar;
			}
			$array[$i++] = array(
				'kode_pemesanan' => $list->kode_pemesanan,
				'email_pelanggan' => $list->email_pelanggan,
				'jml_pesanan' => $jml_barang,
				'total_bayar' => $jml_bayar,
				'waktu_pemesanan' => $list->waktu_pemesanan,
				'status' => $list->status
			);
		}
		return $array;
	}

	public function getKodePemesanan($email){
		$column = array(
			'tbl_pesanan.kode_pemesanan',
			'tbl_pengiriman.waktu_pemesanan',
			'tbl_pesanan.email_pelanggan',
			'tbl_pengiriman.status'
		);

		$this->db->select($column);
		$this->db->from('tbl_pesanan');
		$this->db->join('tbl_pengiriman','tbl_pesanan.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
		$this->db->join('tbl_pelanggan','tbl_pesanan.email_pelanggan = tbl_pelanggan.email_pelanggan','inner');
		$this->db->join('tbl_barang','tbl_pesanan.kode_barang = tbl_barang.kode_barang','inner');
		$this->db->where('tbl_pesanan.email_pelanggan',$email);
		$this->db->order_by('tbl_pesanan.waktu_pemesanan','DESC');
		$this->db->group_by('tbl_pesanan.kode_pemesanan');
		$query = $this->db->get();

		return $query;
	}

	public function getDetailPemesanan($id=null,$user=null){
		$email = $user['username'];
		$column = array(
			'tbl_barang.kode_barang',
			'tbl_kategori.nama_kategori',
			'tbl_barang.nama_barang',
			'tbl_barang.harga',
			'tbl_barang.foto',
			'tbl_pesanan.jml_pesanan',
			'tbl_pesanan.total_bayar',
			'tbl_pengiriman.kode_pemesanan',
			'tbl_pengiriman.nama',
			'tbl_pengiriman.no_telp',
			'tbl_provinsi.provinsi',
			'tbl_pengiriman.kota',
			'tbl_pengiriman.kecamatan',
			'tbl_pengiriman.kode_pos',
			'tbl_pengiriman.detail_alamat',
			'tbl_pengiriman.waktu_pemesanan',
			'tbl_pengiriman.status',
			'tbl_pelanggan.foto'
		);

		$this->db->select($column);
		$this->db->from('tbl_pengiriman');
		$this->db->join('tbl_pesanan','tbl_pengiriman.kode_pemesanan = tbl_pesanan.kode_pemesanan','inner');
		$this->db->join('tbl_barang','tbl_pesanan.kode_barang = tbl_barang.kode_barang','inner');
		$this->db->join('tbl_kategori','tbl_barang.kode_kategori = tbl_kategori.kode_kategori','inner');
		$this->db->join('tbl_provinsi','tbl_pengiriman.id_provinsi = tbl_provinsi.id_provinsi','inner');
		$this->db->join('tbl_pelanggan','tbl_pesanan.email_pelanggan = tbl_pelanggan.email_pelanggan','inner');
		$this->db->where('tbl_pengiriman.kode_pemesanan',$id);
		$this->db->where('tbl_pelanggan.email_pelanggan',$email);
		$query = $this->db->get();

		return $query;
	}

	public function konfirmasi($kode=null, $data=null, $user=null){
		$email = $user['username'];

		$this->db->select('tbl_pesanan.kode_pemesanan','tbl_pesanan.email_pelanggan');
		$this->db->from('tbl_pesanan');
		$this->db->join('tbl_pengiriman','tbl_pesanan.kode_pemesanan = tbl_pengiriman.kode_pemesanan','inner');
		$this->db->join('tbl_pelanggan','tbl_pesanan.email_pelanggan = tbl_pelanggan.email_pelanggan','inner');
		$this->db->where('tbl_pesanan.kode_pemesanan',$kode);
		$this->db->where('tbl_pesanan.email_pelanggan',$email);
		$q = $this->db->get();
		$cek = $q->row();
		if($cek!=null){
			$data['kode_pemesanan'] = $cek->kode_pemesanan;
			return $this->db->insert('tbl_konfirmasi',$data);
		}else{
			return false;
		}
	}
}