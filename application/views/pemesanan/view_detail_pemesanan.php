<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('include/head'); ?>
	<link href="<?= URL_ ?>css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?= URL_ ?>css/dataTables.bootstrap.min.css" rel="stylesheet">
    <?php $this->load->view('include/navigation'); ?>
    <?php //$this->load->view('include/intro'); ?>
	<body id="page-top" class="index">
		<div class="container">
			<div class="table-responsive" style="padding-top: 120px">
			<center><h3>Riwayat<br> Detail Pemesanan Barang</h3></center>
				<table class="table table table-hover table-striped" id="data" style="margin-top: 50px;">
					<thead>
						<tr>
							<th>NO</th>
							<th>Barang</th>
							<th>Kategori</th>
							<th>Qty</th>
							<th>Total Bayar</th>
							<th>Foto</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach($detail->result() as $data) { ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data->nama_barang ?></td>
							<td><?= $data->nama_kategori ?></td>
							<td><?= $data->jml_pesanan ?></td>
							<td>Rp. <?= number_format($data->total_bayar) ?></td>
							<td><?= $data->foto ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php $this->load->view('include/js'); ?>
		<script src="<?= URL_ ?>js/jquery.dataTables.min.js"></script>
		<script src="<?= URL_ ?>js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
		    $(document).ready(function() {
		        $('#data').DataTable();
		    } );
		</script>
	</body>
</html>










<?php /*
<!-- <a class="btn btn-info" data-toggle="modal" href='#detail_<?= $pemesanan[$i]['kode_pemesanan'] ?>'>Detail</a>
<div class="modal fade" id="detail_<?= $pemesanan[$i]['kode_pemesanan'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body" style="text-align:left;">
				<?php foreach($detail->result() as $penerima) { }?>
                <table>
                    <tr>
                        <td><label>Nama Penerima</label></td>
                        <td>&nbsp; : &nbsp; <?= $penerima->nama ?></td>
                    </tr>
                    <tr>
                        <td><label>No. HP</label></td>
                        <td>&nbsp; : &nbsp; <?= $penerima['no_telp'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Alamat</label></td>
                        <td>&nbsp; : &nbsp; <?= $penerima['detail_alamat'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Total Belanja</label></td>
                        <td>&nbsp; : &nbsp; Rp.<?= number_format($pemesanan[$i]['total_bayar']) ?></td>
                    </tr>
                    <tr>
                        <td><label>Status</label></td>
                        <td>&nbsp; : &nbsp; <strong><?= $pemesanan[$i]['status'] ?></strong> 
                             <i class="glyphicon <?php if($pel['status']=="Terkirim")echo "glyphicon-send"; if($pel['status']=="Menunggu")/* ?>echo "glyphicon-refresh"; if($pel['status']=="Batal")echo "glyphicon-remove";?>"></i> -->
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
								<th>NO</th>
								<th>Barang</th>
								<th>Kategori</th>
								<th>Qty</th>
								<th>Total Bayar</th>
								<th>Foto</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($detail->result() as $data) { ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data->nama_barang ?></td>
								<td><?= $data->nama_kategori ?></td>
								<td><?= $data->jml_pesanan ?></td>
								<td>Rp. <?= number_format($data->total_bayar) ?></td>
								<td><?= $data->foto ?></td>
							</tr>
							<?php } ?>
						</tbody>
				    </table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>--> */ ?>