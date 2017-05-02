<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public $session_data;
	function __construct(){
		parent::__construct();
		$this->session_data = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in') || $this->session_data['level']!="admin"){
			redirect(URL_.'signin','refresh');
		}
		$this->data['menu'] = array(
            'parent'=>'barang',
            'status' => 'active'
        );
        $this->load->model('admin/Model_Kategori');
        $this->load->model('admin/Model_Barang');
        $this->data['kategori'] = $this->Model_Kategori->get();
    }

    function index(){
        $this->data['menu']['label'] = "barang";
        $this->data['barang'] = $this->Model_Barang->getAll();
        $this->load->view('admin/barang/view_barang', $this->data);
    }

    public function submit(){
        if(isset($_POST['input']) || isset($_POST['edit'])){
            $file_name = "";

            if($_FILES['foto']['size'] > 0){
                echo"<script>alert('1')</script>";
                $file_name = md5(time());
                $this->load->library('upload');
                $config['upload_path']          = './img/barang';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')){
                    //@unlink(URL_.'img/barang/'.$this->input->post('file_foto'));
                    $this->load->helper('file');
                    delete_files(URL_."img/barang/".$this->input->post('file_foto'));
                    $file_name .= $this->upload->file_ext;
                    $gbr = $this->upload->data();
                }else{
                    //echo"<script>alert('Upload gambar gagal !')</script>";
                }
            }else{
                //echo"<script>alert('Upload gambar gagal !')</script>";
            }

            $data = array(
                'nama_barang' => $this->input->post('nama_barang'),
                'kode_kategori' => $this->input->post('kategori'),
                'harga' => $this->input->post('harga'),
                'stok'=> $this->input->post('stok'),
                'keterangan' => $this->input->post('keterangan'),
                'foto' => $file_name
            );

            if(isset($_POST['input'])){
                $data['kode_barang'] = $this->input->post('kategori').substr(time(), -7); 
                if($this->Model_Barang->input($data)){
                    echo"<script>alert('Data Tersimpan !')</script>";
                    redirect('admin/barang','refresh');
                }
            }elseif(isset($_POST['edit'])){
                $id = $this->input->post('edit');
                if($this->Model_Barang->update($data,$id)){
                    echo"<script>alert('Data Tersimpan !')</script>";
                    redirect('admin/barang','refresh');
                }
            }else{
                echo"<script>alert('Gagal Tersimpan !')</script>";
            }

        }else{
            redirect('admin/barang','refresh');
        }
    }

    public function delete(){
        if(isset($_POST['delete'])){
            $id = $this->input->post('delete');
            if($this->Model_Barang->delete($id)){
                echo"<script>alert('Data Terhapus !')</script>";
                redirect('admin/barang','refresh');
            }else{
                echo"<script>alert('Gagal menghapus !')</script>";
                redirect('admin/barang','refresh');
            }
        }
    }

    public function edit($id){
        $this->data['edit'] = $this->Model_Barang->getEdit($id);
        $this->load->view('admin/barang/view_edit_barang', $this->data);
    }

    public function dataJson(){
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $search = $this->input->get('search');
        $list = $this->Model_Barang->getJSON($start, $end, $search);

        $data = array();

        $no = $_POST['start'];
        foreach ($list as $dt) {
            $row = array();
            $row[] = ++$no; 
            $row[] = "<a href='".URL_."admin/barang/edit/".$dt->kode_barang."' class='btn btn-info'>Edit</a>
                      <a class='btn btn-danger' data-toggle='modal' href='#hapus_".$dt->kode_barang."'>Hapus</a>";
            $row[] = $dt->kode_barang;
            $row[] = $dt->nama_barang;
            $row[] = $dt->nama_kategori;
            $row[] = number_format($dt->harga);
            $row[] = number_format($dt->stok);
            //$row[] = $dt->foto;
            $data[] = $row; 
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_Barang->count_all(),
            "recordsFiltered" => $this->Model_Barang->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
}