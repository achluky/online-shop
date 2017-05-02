<a class="btn btn-primary" data-toggle="modal" href='#modal_input'>Input Kategori</a>
<div class="modal fade" id="modal_input">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Input Data Kategori</h4>
			</div>
			<form action="kategori/input" method="POST" role="form" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Kode Kategori</label>
						<input type="text" name="kode_kategori" class="form-control" id="" placeholder="Kode Kategori">
					</div>
					<div class="form-group">
						<label for="">Nama Kategori</label>
						<input type="text" name="kategori" class="form-control" id="" placeholder="Kategori">
					</div>
					
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary" name="input">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>