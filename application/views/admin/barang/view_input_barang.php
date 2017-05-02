<a class="btn btn-primary" data-toggle="modal" href='#modal_input'>Input Barang</a>
<div class="modal fade" id="modal_input">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Input Data Barang</h4>
			</div>
			<form action="barang/submit" method="POST" role="form" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control" id="" placeholder="Nama Barang">
					</div>
					<div class="form-group">
						<label for="">Kategori</label>
						<select class="form-control" name="kategori">
							<?php 
								foreach ($kategori->result() as $kat) {
									echo "<option value='".$kat->kode_kategori."'>".$kat->nama_kategori."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="form-control" id="" placeholder="Harga">
					</div>
					<div class="form-group">
						<label for="">Stok</label>
						<input type="number" name="stok" class="form-control" id="" placeholder="Stok" min="0">
					</div>
					<div class="form-group">
						<label for="">Keterangan</label>
						<textarea class="form-control" name="keterangan"></textarea>
					</div>
					<div class="form-group">
						<label for="">Foto</label>
						<input type="file" name="foto" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary" name="input">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>