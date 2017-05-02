<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('admin/include/head'); ?>
</head>
<body>
    <?php $this->load->view('admin/include/navigation'); ?>
    
    <div id="page-wrapper" class="gray-bg">
    
    <?php
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/breadcrumb');
        $barang = $edit->row();
    ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit barang <?= $barang->nama_barang; ?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    <?php //$this->load->view('admin/barang/view_input_barang'); ?>
                        <form action="<?= URL_ ?>admin/barang/submit" method="POST" role="form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Kode Barang</label>
                                    <input type="text" name="kode_barang" class="form-control" id="" placeholder="Kode Barang" value="<?= $barang->kode_barang; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" id="" placeholder="Nama Barang" value="<?= $barang->nama_barang; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <?php 
                                            $select = "";
                                            foreach ($kategori->result() as $kat) {
                                                $select = ($kat->kode_kategori==$barang->kode_kategori) ? "selected" : "";

                                                echo "<option value='".$kat->kode_kategori."' $select>".$kat->nama_kategori."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="" placeholder="Harga" value="<?= $barang->harga; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stok" class="form-control" id="" placeholder="Stok" min="0" value="<?= $barang->stok; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" style="height:200px;"><?= $barang->keterangan; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                    <input type="hidden" name="file_foto" class="form-control" value="<?= $barang->foto ?>">
                                </div>
                                <div class="form-group">
                                    <img src="<?= URL_ ?>img/barang/<?= $barang->foto ?>" style="width: 50%;">    
                                </div>
                                <div style="float:right;">
                                    <button type="back" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="edit" value="<?= $barang->kode_barang; ?>">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    $this->load->view('admin/include/footer');
    $this->load->view('admin/include/js'); 
    ?>
    </body>
</html>
