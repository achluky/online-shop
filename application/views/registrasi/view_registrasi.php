<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('include/head'); ?>
    <?php //$this->load->view('include/navigation'); ?>

    <body id="page-top" class="index"> 


    	
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="registrasi/input" method="POST" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="back" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center><h4 class="modal-title">Form Registrasi Pelanggan</h4></center>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="tgl_lahir" class="form-control">
						</div>
						<div class="form-group">
							<label>No Telp</label>
							<input type="phone" name="no_telp" class="form-control">
						</div>
						<div class="form-group">
							<label>Provinsi</label>
							<select name="provinsi" class="form-control">
								<?php 
									foreach ($provinsi->result() as $prov) {
										echo "<option value='$prov->id_provinsi'>$prov->provinsi</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Kota</label>
							<input type="text" name="kota" class="form-control">
						</div>
						<div class="form-group">
							<label>Kecamatan</label>
							<input type="text" name="kecamatan" class="form-control">
						</div>
						<div class="form-group">
							<label>Kode Pos</label>
							<input type="text" name="kode_pos" class="form-control">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="alamat" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="pass1" class="form-control">
						</div>
						<div class="form-group">
							<label>Konfirmasi Password</label>
							<input type="password" name="pass2" class="form-control">
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-default" data-dismiss="modal">Clear</button>
						<button type="submit" class="btn btn-primary" name="input">Registrasi</button>
					</div>
				</form>
			</div>
		</div>
    	

    <?php $this->load->view('include/js'); ?>
    </body>
</html>