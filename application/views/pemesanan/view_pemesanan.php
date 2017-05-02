<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('include/head'); ?>
    <?php $this->load->view('include/navigation'); ?>
    <?php $this->load->view('include/intro'); ?>
	<body id="page-top" class="index">



    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Tahap Pemesanan</h2>
                    <h3 class="section-subheading text-muted">Tiga Langkah Cara Memesan</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x" <?php if($empty){echo "title='Anda Belum Memesan Produk Manapun !'";}else{echo "title='Tahap Pemesanan Selesai !'";} ?>>
                        <i class="fa fa-circle fa-stack-2x <?php if($empty){echo "text-primary";}else{echo "text-success";} ?>"></i>
                        <i class="fa <?php if($empty) echo "fa-unlock"; else echo "fa-check"; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <h3 class="service-heading">Memilih Pesanan</h3>
                    <table class="table table-hover" style="margin-bottom: 0px;">           
                        <tbody>
                        <?php
                            //$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
                            $no=1;
                            $total = 0;
                            foreach ($barang->result() as $list){ ?>
                                <tr>
                                    <td style="vertical-align: middle; padding-left:15px;"><?php echo $no." &nbsp;"; ?></td>
                                    <td style="vertical-align: middle;"><a href="<?php echo URL_."img/barang/".$list->foto; ?>" style="color: #5bc0de" target="_blank">
                                        <img src="<?php echo URL_."img/barang/".$list->foto; ?>" class="img-circle" style="width:30px; height:30px;">
                                        </a>
                                    </td>
                                    <td style="text-align: left; vertical-align: middle;">&nbsp; <?php echo $list->nama_barang; ?></td>
                                    <td style="text-align: right; vertical-align: middle; padding-right:15px;" id="harga_<?php echo $no;?>"><?php echo " Rp. ".number_format($list->harga); ?></td>
                                </tr>
                            <?php
                            $no++;
                            $total += $list->harga;
                            }
                        ?>
                        </tbody>
                    </table>
                    <li class="devider"></li>
                    <?php if(isset($_GET['id']) && $empty){ ?>
                        <p class="text-muted">Anda Belum Memilih Produk Manapun Untuk Dipesan, Klik Tombol Dibawah Ini Untuk Memilih Produk Pesanan.</p>
                        <a class="page-scroll btn btn-primary" href="../#portfolio">Pilih Produk</a>
                        <li class="devider"></li>
                    <?php
                    } ?>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x " <?php if(isset($_POST['beli_banyak']) && !$empty)echo "title='Anda Belum Mengisi Data Pemesanan !'"; elseif(isset($_GET['id']) && !$empty) echo "title='Data Pemesanan Telah Tersimpan !'";?>>
                        <i class="fa fa-circle fa-stack-2x <?php if(isset($_POST['beli_banyak']) && !$empty)echo "text-primary"; elseif(!$empty) echo "text-success"; else echo "text-gray"; ?>"></i>
                        <i class="fa <?php if(isset($_POST['beli_banyak']) && !$empty)echo "fa-unlock"; elseif(!$empty)echo "fa-check"; else echo "fa-lock"; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <h3 class="service-heading">Isi Data Pemesanan</h3>
                    <li class="devider"></li>
                    <?php 
                    if(isset($_POST['beli_banyak']) && !$empty){ ?>
                        <p class="text-muted">Harap Isi Data Pemesanan Anda Dengan Benar, Karena Data Tersebut Akan Digunakan Untuk Melakukan Pengiriman Produk.</p>
                    <?php } 
                    elseif(isset($_GET['id']) && !$empty){ ?>
                        <p class="text-muted">Harap Diingat Bahwa Data Yang Sudah Tersimpan Tidak Dapat Diubah, Namun Jika Ada Kesalahan Pengisian Data, Kami Menyarankan Agar Anda Melakukan Pemesanan Ulang.</p>
                    <?php }
                    else{ ?>
                        <p class="text-muted">Tahap Ini Akan Terbuka Jika Anda Sudah Memilih Produk Untuk Dipesan.</p>
                    <?php }
                    if(!$empty){ ?>
                    <button class="btn btn-primary" data-toggle="modal" href='#modal-id'><?php if(isset($_POST['beli_banyak']) && $jml_pesanan > 0) echo"Isi Data"; elseif(!$empty) echo "Lihat Data";?></button>
                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Data Pengiriman</h4>
                                </div>
                                <form action="pemesanan/submit" method="POST">
                                    <?php if(isset($_POST['beli_banyak']) && !$empty){ 
                                            foreach($pelanggan->result() as $user){
                                        ?>
                                        <div class="modal-body" style="text-align:left;">
                                            <input type='hidden' name='action' value='pelanggan'>
                                            <div class="form-group">
                                                <label style="float:left;">Nama Penerima</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" required value="<?= $user->nama; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label style="float:left;">No. Telepon</label>
                                                <input type="tel" class="form-control" name="no_telp" placeholder="Contoh : 085789012345" required value="<?= $user->no_telp; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" class="form-control">
                                                    <?php 
                                                        $select = "";
                                                        foreach ($provinsi->result() as $prov) {
                                                            if($prov->id_provinsi==$user->id_provinsi){
                                                                $select = "selected";
                                                            }else{
                                                                $select = "";
                                                            }
                                                            echo "<option value='$prov->id_provinsi' $select>$prov->provinsi</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" name="kota" class="form-control" value="<?= $user->kota ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="text" name="kecamatan" class="form-control" value="<?= $user->kecamatan ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Pos</label>
                                                <input type="text" name="kode_pos" class="form-control" value="<?= $user->kode_pos ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control"><?= $user->detail_alamat ?></textarea>
                                            </div>
                                            <center><h4 class="service-heading">Daftar Pesanan</h4></center>
                                            <li class="devider"></li>
                                            <div class="table-responsive">
                                                <table class="table table-hover" style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding-left:15px;">No</th>
                                                            <th>Img</th>
                                                            <th>Nama</th>
                                                            <th>Jml</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        //$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
                                                        $no=1;
                                                        $total = 0;
                                                        foreach ($barang->result() as $list){ ?>
                                                            <tr>
                                                                <td style="vertical-align: middle; padding-left:15px;"><?php echo $no." &nbsp;"; ?></td>
                                                                <td style="vertical-align: middle;"><a href="<?php echo URL_."img/barang/".$list->foto; ?>" style="color: #5bc0de" target="_blank">
                                                                    <img src="<?php echo URL_."img/barang/".$list->foto; ?>" class="img-circle" style="width:30px; height:30px;">
                                                                    </a>
                                                                </td>
                                                                <td style="text-align: left; vertical-align: middle;">&nbsp; <?php echo $list->nama_barang; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="idm[]" value="<?php echo $list->kode_barang; ?>">
                                                                    <input type="number" id="quantity" onchange="updateQty(this.value)" class="form-control" min="1" step="1" name="qty[]" style="width: 60px" value="1">
                                                                </td>
                                                                <td style=" vertical-align: middle; padding-right:15px;" id="harga_<?php echo $no;?>"><?php echo " Rp. ".number_format($list->harga); ?></td>
                                                            </tr>
                                                        <?php
                                                        $no++;
                                                        $total += $list->harga;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align: left; vertical-align: middle; padding-left:15px;"><strong><?php echo "TOTAL";?></strong></td> 
                                                        <!--<td id="qty"><?php //echo $jml_pesanan; ?></td>-->
                                                        <td colspan="1" style=" vertical-align: middle; padding-right:15px;"><strong style="color:red"><?php echo "Rp. ".number_format($total); ?></strong></td> 
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-success" name="data_pelanggan" value="true">
                                                <span class="glyphicon glyphicon-floppy-disk"></span> 
                                                SUBMIT
                                            </button>
                                        </div>

                                    <?php } elseif(isset($_GET['id']) && !$empty) { 
                                        $pel = PdoSelect("SELECT b.id_pesanan, b.id_pelanggan, a.no_hp, a.nama, a.alamat, b.total_harga, b.status FROM pelanggan a, pesanan b WHERE b.id_pelanggan=a.id_pelanggan AND b.id_pesanan='$id_pesanan'");
                                    ?>
                                        <div class="modal-body" style="text-align:left;">
                                            <table>
                                                <tr>
                                                    <td><label>Nama</label></td>
                                                    <td>&nbsp; : &nbsp; <?php echo $pel['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><label>No. HP</label></td>
                                                    <td>&nbsp; : &nbsp; <?php echo $pel['no_hp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Alamat</label></td>
                                                    <td>&nbsp; : &nbsp; <?php echo $pel['alamat']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Total Belanja</label></td>
                                                    <td>&nbsp; : &nbsp; Rp.<?php echo $pel['total_harga']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Status</label></td>
                                                    <td>&nbsp; : &nbsp; <strong><?php echo $pel['status']; ?></strong> 
                                                        <i class="glyphicon <?php if($pel['status']=="Terkirim")echo "glyphicon-send"; if($pel['status']=="Menunggu")echo "glyphicon-refresh"; if($pel['status']=="Batal")echo "glyphicon-remove";?>"></i>
                                                    </td>
                                                </tr>
                                            </table>
                                            <li class="devider"></li>
                                            <center><h5>Daftar Pesanan</h5></center>
                                            <li class="devider"></li>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped" style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Img</th>
                                                            <th>Nama</th>
                                                            <th>Jml</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <!-- <tbody>
                                                        <?php
                                                            $q = PdoQuery("SELECT a.foto, a.nama, b.jumlah, a.harga, c.total_harga FROM masakan a, detail_pesanan b, pesanan c WHERE b.id_pesanan=c.id_pesanan AND b.id_masakan=a.id_masakan and c.id_pesanan='$id_pesanan';");
                                                            $no=1;
                                                            $total_harga = 0;
                                                            $jml_produk = 0;
                                                            while ($list = $q->fetch(PDO::FETCH_ASSOC)){
                                                                $total_harga += $list['harga']*$list['jumlah'];
                                                                $jml_produk += $list['jumlah'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><a href="../img/masakan/<?php echo $list['foto']; ?>" target="_blank"><img src="../img/masakan/<?php echo $list['foto']; ?>" class="img-circle" style="width:30px; height:30px;">
                                                                </a>
                                                            </td>
                                                            <td><?php echo $list['nama']; ?></td>
                                                            <td><?php echo $list['jumlah']; ?></td>
                                                            <td>Rp.<?php echo $list['harga']; ?></td>
                                                            <td>Rp.<?php echo ($list['harga']*$list['jumlah']); ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td colspan="3"><strong><?php echo "TOTAL";?></strong></td> 
                                                            <td colspan="2"><strong><?php echo $jml_produk;?></strong></td> 
                                                            <td ><strong style="color:red"><?php echo "Rp. $total_harga";?></strong></td> 
                                                        </tr>
                                                    </tbody> -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                        </div>
                                    <?php } ?>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <?php   
                    }
                    ?> 
                    <li class="devider"></li>  
                </div>

                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x <?php if(isset($_POST['beli_banyak']) && !$empty)echo "text-gray"; elseif(isset($_GET['id']) && !$empty && $status=="Menunggu")echo "text-primary"; elseif(isset($_GET['id']) && !$empty && $status=="Batal")echo "text-danger"; elseif(isset($_GET['id']) && !$empty && $status == "Terkirim") echo"text-success"; ?>"></i>
                        <i class="fa <?php if(isset($_POST['beli_banyak']) || $empty)echo "fa-lock"; elseif(isset($_GET['id']) && !$empty && $status=="Menunggu")echo "fa-unlock"; elseif(isset($_GET['id']) && !$empty && $status == "Batal") echo"fa-close"; elseif(isset($_GET['id']) && !$empty && $status == "Terkirim") echo"fa-check"; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <h3 class="service-heading">Pengiriman Pesanan</h3>
                    <li class="devider"></li>
                    <?php 
                    if(isset($_POST['beli_banyak']) && !$empty){ ?>
                        <p class="text-muted">Untuk Membuka Tahap Ini Anda Harus Menyelesaikan Tahap Pegisian Data Pesanan.</p>
                    <?php }elseif(isset($_GET['id']) && !$empty && $status == "Menunggu"){ ?>
                        <p class="text-muted">Saat Ini Data Pesanan Anda Sedang Diverifikasi, Harap Menunggu Sejenak.</p>
                    <?php }elseif(isset($_GET['id']) && !$empty && $status == "Terkirim"){ ?>
                        <p class="text-muted"><strong>Pesanan Telah Terkirim</strong><br>Terimakasih Anda Telah Melakukan Pemesanan, Klik Tombol Di Bawah Ini Jika Anda Ingin Memesan Produk.</p>
                        <a class="page-scroll btn btn-primary" href="../#portfolio">Pilih Produk</a>
                    <?php }elseif(isset($_GET['id']) && !$empty && $status == "Batal"){ ?>
                        <p class="text-muted"><strong>Pesanan Dibatalkan !</strong><br>Karena Alasan Tertentu Kami Membatalkan Pesanan Anda, Untuk Informasi Lebih Lanjut Silahkan Hubungi Kami<br>Atau<br>Klik Tombol Di Bawah Ini Jika Anda Ingin Memesan Produk.</p>
                        <a class="page-scroll btn btn-primary" href="../#portfolio">Pilih Produk</a>
                    <?php }else{ ?>
                        <p class="text-muted">Tahap Ini Akan Terbuka Jika Anda Sudah Memilih Produk Untuk Dipesan Dan Mengisi Data Pemesanan.</p>
                    <?php
                    }
                    ?>
                    <li class="devider"></li>
                </div>
            </div>
        </div>
    </section>



    
    
    <?php
		$this->load->view('include/js'); 
	?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data').DataTable();
        } );

        function updateQty(num){
            //var val = num;
            //var q = parseInt(document.getElementById("qty").innerHTML)+num;
            //var n = (q-num) + num; 
            //var n = val + num;
            //var n = num;
            var harga = document.getElementById("harga_1").value;
            //var total = 0;
            //total = n * harga; 
            document.getElementById("harga_2").innerHTML = harga;
        }
            
    </script>
	</body>
</html>