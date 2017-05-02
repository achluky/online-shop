<?php
if(isset($_POST['kirim'])){
    $id_pesanan = filter($_POST['kirim']);
    if(PdoQuery("UPDATE pesanan SET status='Terkirim' WHERE id_pesanan='$id_pesanan'")){
        echo "<script>window.location=''</script>";
    }
}elseif(isset($_POST['batal'])){
    $id_pesanan = filter($_POST['batal']);
    if(PdoQuery("UPDATE pesanan SET status='Batal' WHERE id_pesanan='$id_pesanan'")){
        echo "<script>window.location=''</script>";
    }
}
?>

<!-- Services Section -->
<section id="pesanan" style="padding-top:100px;">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom: 30px;">
                <h3 class="section-heading">Daftar Pesanan</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table table-hover table-striped" id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. HP</th>
                        <th>Nama</th>
                        <th>Total Belanja</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $sql = PdoQuery("SELECT b.id_pesanan, b.id_pelanggan, a.no_hp, a.nama, a.alamat, b.total_harga, b.status FROM pelanggan a, pesanan b WHERE b.id_pelanggan=a.id_pelanggan ORDER BY b.status='Menunggu' DESC");
                        while($pelanggan = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $pelanggan['no_hp']; ?></td>
                                <td><?php echo $pelanggan['nama']; ?></td>
                                <td>Rp.<?php echo $pelanggan['total_harga']; ?></td>
                                <td><?php echo $pelanggan['status']; ?></td>
                                <td>

                                    <?php if($pelanggan['status']!="Terkirim" && $pelanggan['status']!="Batal") { ?>
                                    <button class="btn btn-success" data-toggle="modal" href="#kirim_<?php echo $pelanggan['id_pesanan']; ?>">Kirim</button>
                                    <div class="modal fade" id="kirim_<?php echo $pelanggan['id_pesanan']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Kirim</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin <strong>MENGUBAH STATUS</strong> pesanan <strong><?php echo $pelanggan['nama'] ?></strong> menjadi terkirim ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="POST">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-success" name="kirim" value="<?php echo $pelanggan['id_pesanan']; ?>">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>


                                    <?php if($pelanggan['status']!="Terkirim"  && $pelanggan['status']!="Batal") { ?>
                                    <button class="btn btn-danger" data-toggle="modal" href="#batal_<?php echo $pelanggan['id_pesanan']; ?>">Batal</button>
                                    <div class="modal fade" id="batal_<?php echo $pelanggan['id_pesanan']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Pembatalan</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin <strong>MEMBATALKAN</strong> pesanan dari <strong><?php echo $pelanggan['nama'] ?></strong> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="POST">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger" name="batal" value="<?php echo $pelanggan['id_pesanan']; ?>">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>




                                    <button class="btn btn-info" data-toggle="modal" href="#detail_<?php echo $pelanggan['id_pesanan']; ?>">Detail</button>
                                    <div class="modal fade" id="detail_<?php echo $pelanggan['id_pesanan']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Detail Pesanan</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <td><label>Nama</label></td>
                                                            <td>: &nbsp; <?php echo $pelanggan['nama']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>No. HP</label></td>
                                                            <td>: &nbsp; <?php echo $pelanggan['no_hp']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Alamat</label></td>
                                                            <td>: &nbsp; <?php echo $pelanggan['alamat']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Total Belanja</label></td>
                                                            <td>: &nbsp; Rp.<?php echo $pelanggan['total_harga']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Status</label></td>
                                                            <td>: &nbsp; <strong><?php echo $pelanggan['status']; ?></strong> 
                                                                <i class="glyphicon <?php if($pelanggan['status']=="Terkirim")echo "glyphicon-send"; if($pelanggan['status']=="Menunggu")echo "glyphicon-refresh"; if($pelanggan['status']=="Batal")echo "glyphicon-remove";?>"></i>
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
                                                            <tbody>
                                                                <?php
                                                                    $q = PdoQuery("SELECT a.foto, a.nama, b.jumlah, a.harga, c.total_harga FROM masakan a, detail_pesanan b, pesanan c WHERE b.id_pesanan=c.id_pesanan AND b.id_masakan=a.id_masakan and c.id_pesanan='$pelanggan[id_pesanan]';");
                                                                    $num=1;
                                                                    $total_harga = 0;
                                                                    $jml_produk = 0;
                                                                    while ($list = $q->fetch(PDO::FETCH_ASSOC)){
                                                                        $total_harga += $list['harga']*$list['jumlah'];
                                                                        $jml_produk += $list['jumlah'];
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $num++; ?></td>
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
      $('.data').DataTable();
    });
</script>
<!-- Services Section -->
