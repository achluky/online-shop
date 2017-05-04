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
			<center><h3>Riwayat<br> Pemesanan Barang</h3></center>
				<table class="table table table-hover table-striped" id="data" style="margin-top: 50px;">
					<thead>
						<tr>
							<th>NO</th>
							<th>Kode Pemesanan</th>
							<th>Jumlah Barang</th>
							<th>Total Pembayaran</th>
							<th>Waktu Pemesanan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i=0; $i < count($pemesanan); $i++) { ?>
						<tr>
							<td><?= $i+1 ?></td>
							<td>#<?= $pemesanan[$i]['kode_pemesanan']?></td>
							<td><?= number_format($pemesanan[$i]['jml_pesanan'])?></td>
							<td>Rp. <?= number_format($pemesanan[$i]['total_bayar'])?></td>
							<td><?= $pemesanan[$i]['waktu_pemesanan']?></td>
							<td><?= $pemesanan[$i]['status']?></td>
							<td>
								<?php //$this->load->view('pemesanan/view_detail_pemesanan'); ?>
								<a class="btn btn-info" href='<?= URL_ ?>riwayat/pemesanan/<?= $pemesanan[$i]['kode_pemesanan'] ?>'>Detail</a>
								
								<a class="btn btn-success" data-toggle="modal" href='#modal_<?= $i ?>'>Konfirmasi</a>
								<div class="modal fade" id="modal_<?= $i ?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="konfirmasi" method="POST" enctype="multipart/form-data">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<center><h4 class="modal-title">Konfirmasi Pembayaran</h4></center>
												</div>
												<div class="modal-body">
						                            <div class="form-group" style="width:100%; padding: 10px 5px;">
						                            	<label>Judul Pesan</label>
						                                <input type="text" style="width:100%" name="judul" class="form-control">
						                                <input type="hidden" name="kode" value="<?= $pemesanan[$i]['kode_pemesanan'] ?>">
						                            </div>
						                            <div class="form-group" style="width:100%; padding: 10px 5px;">
						                            	<label>Deskripsi</label>
						                                <textarea class="form-control" style="width:100%; height: 100px;" name="deskripsi"></textarea>
						                            </div>
						                            <div class="form-group" style="width:100%; padding: 10px 5px;">
						                            	<label>Bukti Pembayaran</label>
						                                <input type="file" class="form-control" style="width:100%;" name="foto">
						                            </div>
						                            <div class="devider"></div>
						                            <div class="form-group" style="width:100%; padding: 10px 5px; text-align: justify;">
						                            	<small >
						                            	<b>Segera lakukan pembayaran ke nomor rekening xxxxxxxxxx, dan konfirmasi segera setelah anda menyelesaikan pembayaran tersebut. 
						                            	Jika dalam waktu 6 jam anda belum melakukan pembayaran, maka pesanan anda akan secara otomatis kadaluarsa.</b>
						                            	</small>
						                            </div>
						                        </div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
													<button type="submit" class="btn btn-success" name="konfirmasi">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</td>
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