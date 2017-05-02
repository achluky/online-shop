<?php
    $target_file = "";
    if(isset($_FILES['foto'])){

        $file_name = basename( $_FILES["foto"]["name"]);
        $target_dir = "../img/masakan/";
        $uploadOk = 1;
        
        // Check if image file is a actual image or fake image
        if(!empty($_FILES['foto']['name'])) {

            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $extention = array ('jpg','png','jpeg','bmp','gif');
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $getExtensi = strtolower(end(explode('.', $_FILES['foto']['name'])));
            
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Gambar Tidak Valid !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();
                $uploadOk = 0;
            }

            $target_file = md5(microtime()) . ".$getExtensi";
            
            // Check file size
            if ($_FILES["foto"]["size"] > 16000000) {
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Ukuran Gambar Maksimal 15Mb !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();
                $uploadOk = 0;
            }
            // Allow certain file formats
            if(!in_array($getExtensi, $extention)){
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Hanya Menerima Ekstensi JPG, JPEG, PNG dan GIF !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Unggah Gambar Gagal !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();

            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $target_file)) {
                    //Input atau Edit
                } else {
                    echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Terjadi Kesalahan Saat Unggah Gambar !</div>";
                    echo "<meta http-equiv='refresh' content='2,'/>";
                    exit();
                }
            }
        }else{
            if(isset($_POST['input'])){
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Harap Pilih Gambar !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();
            }
        }
    }

    if(isset($_POST['input'])){
        
        $nama = filter($_POST['nama']);
        $jenis = filter($_POST['jenis']);
        $deskripsi = filter($_POST['deskripsi']);
        $harga = filter($_POST['harga']);

        $kode = PdoSelect("SELECT MAX(id_masakan) as id FROM masakan");
        if($kode['id']>0){
            $id = $kode['id'] + 1;
        }else{
            $id = 1;
        }

        $field = array('id_masakan','nama','jenis','keterangan','foto','harga');
        $data = array(array($id,$nama,$jenis,$deskripsi,$target_file,$harga));
        
        if(PdoInput("masakan",$field,$data)){
            echo "<script>alert('Data Tersimpan !'); window.location = ''</script>";
        }else{
            echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
        }

    }elseif(isset($_POST['delete'])){
        $id = filter($_POST['delete']);
        if(PdoQuery("DELETE FROM masakan WHERE id_masakan='$id'")){
            echo "<script>window.location = ''</script>";
        }
    }elseif(isset($_POST['edit'])){
        $id = filter($_POST['edit']);
        $nama = filter($_POST['nama']);
        $jenis = filter($_POST['jenis']);
        $deskripsi = filter($_POST['deskripsi']);
        $harga = filter($_POST['harga']);

        $field = array('id_masakan','nama','jenis','keterangan','foto','harga');
        $data = array(array($id,$nama,$jenis,$deskripsi,$target_file,$harga));
        $gambar = "";
        if(isset($target_file) && $target_file!=""){
            $gambar = ", foto='$target_file'";
            $img = PdoSelect("SELECT foto FROM masakan WHERE id_masakan='$id'");
            unlink("../img/masakan/$img[foto]");
        }
        if(PdoQuery("UPDATE masakan SET nama='$nama', jenis='$jenis', keterangan='$deskripsi' $gambar, harga='$harga' WHERE id_masakan='$id'")){
            echo "<script>alert('Data Tersimpan !'); window.location = ''</script>";
        }else{
            echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
        }
    }

?>


<!-- Services Section -->
    <section id="masakan" style="padding-top:100px;">
        <div class="container"> 
            <div class="row">
                <div class="col-lg-12 text-center" style="margin-bottom: 30px;">
                    <h3 class="section-heading">Daftar Masakan</h3>
                </div>
            </div>
            <button class="btn btn-primary" data-toggle="modal" href='#modal-id' style="margin-bottom: 15px;"><span class="fa fa-plus"></span> Input Masakan</button>
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Input Menu Masakan</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Masakan</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Masakan" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Masakan</label>
                                    <select class="form-control" name="jenis">
                                        <option value="Sarapan">Sarapan</option>
                                        <option value="Makan Siang">Makan Siang</option>
                                        <option value="Makan Malam">Makan Malam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga Rp.</label>
                                    <input type="number" min="0" name="harga" class="form-control" placeholder="Harga" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" style="height: 150px;" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" class="form-control" name='foto' required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                                <button type="submit" class="btn btn-primary" name="input">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                $sql = "SELECT *FROM masakan order by id_masakan desc";
                $data = PdoQuery($sql);
            ?>
            <div class="table-responsive">
                <table class="table table table-hover table-striped" id="data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            while($masakan = $data->fetch(PDO::FETCH_ASSOC)){
                                $deskripsi = $masakan['keterangan'];
                                if(strlen($deskripsi) > 15){
                                    $deskripsi = substr($masakan['keterangan'], 0,15).". . .";
                                }?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $masakan['nama']; ?></td>
                                    <td><?php echo $masakan['jenis']; ?></td>
                                    <td>Rp.<?php echo $masakan['harga']; ?></td>
                                    <td><?php echo $deskripsi; ?></td>
                                    <td><a href="../img/masakan/<?php echo $masakan['foto'] ?>" target="_blank"><img src="../img/masakan/<?php echo $masakan['foto'] ?>" class="img-circle" width="50px" height="50px"></a></td>
                                    <td>
                                        <a class="btn btn-danger" data-toggle="modal" href="#hapus_<?php echo $no; ?>"><span class="glyphicon glyphicon-trash" title="Hapus Data"></span></a>
                                        <a class="btn btn-success" data-toggle="modal" href="#edit_<?php echo $masakan['id_masakan']; ?>"><span class="glyphicon glyphicon-edit" title="Edit Data"></span></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapus_<?php echo $no; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><span class="glyphicon glyphicon-warning-sign"></span> Peringatan !</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin <strong>menghapus</strong> menu masakan <strong> <?php echo $masakan['nama']; ?> </strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="" method="POST">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger" name="delete" value="<?php echo "$masakan[id_masakan]"; ?>">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="modal fade" id="edit_<?php echo $masakan['id_masakan']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit Menu Masakan</h4>
                                            </div>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Masakan</label>
                                                        <input type="text" name="nama" class="form-control" placeholder="Nama Masakan" value="<?php echo $masakan['nama']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Masakan</label>
                                                        <select class="form-control" name="jenis">
                                                            <option value="Sarapan" <?php if($masakan['jenis']=="Sarapan"){echo "selected";} ?> >Sarapan</option>
                                                            <option value="Makan Siang" <?php if($masakan['jenis']=="Makan Siang"){echo "selected";} ?>>Makan Siang</option>
                                                            <option value="Makan Malam" <?php if($masakan['jenis']=="Makan Malam"){echo "selected";} ?>>Makan Malam</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Harga Rp.</label>
                                                        <input type="number" min="0" name="harga" class="form-control" placeholder="Harga" value="<?php echo $masakan['harga']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" style="height: 150px;" required><?php echo $masakan['keterangan']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gambar</label>
                                                        <input type="file" class="form-control" name='foto'>
                                                        <img src="../img/masakan/<?php echo $masakan['foto'] ?>" class="img-thumbnail" style="width:100%;">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                                                    <button type="submit" class="btn btn-success" name="edit" value="<?php echo $masakan['id_masakan']; ?>">SIMPAN</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<!-- Services Section -->

