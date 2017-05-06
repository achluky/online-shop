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
	?>

	<div class="wrapper wrapper-content animated fadeInRight">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="ibox float-e-margins">
	                <div class="ibox-title">
	                    <h5>Basic Data Tables example with responsive plugin</h5>
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

	                <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover pesanan" style="width: 1366px; text-align: center;">
			                <thead >
			               		<tr>
	                                <th style="text-align: center;">No</th>
	                                <th style="text-align: center;">Status</th>
	                                <th style="text-align: center;">Aksi</th>
	                                <th style="text-align: center;">Kode Pemesanan</th>
	                                <th style="text-align: center;">Nama</th>
	                                <th style="text-align: center;">No Telp</th>
	                                <th style="text-align: center;">Email</th>
	                                <th style="text-align: center;">Total Bayar</th>
	                                <th style="text-align: center;">Waktu Pemesanan</th>
	                            </tr>
			                </thead>
			                <tbody>
		                		<?php foreach ($konf->result() as $konfirmasi) { ?>
			                	<div class="modal fade" id="konf_<?= $konfirmasi->kode_pemesanan ?>">
			                		<div class="modal-dialog">
			                			<div class="modal-content">
			                				<form action="pesanan/verifikasi" method="POST">
				                				<div class="modal-header">
				                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                					<h4 class="modal-title"><center>#<?= $konfirmasi->kode_pemesanan ?></center></h4>
				                				</div>
				                				<div class="modal-body">
				                					<div class="form-group">
				                						<label>Waktu Konfirmasi</label>
				                						<input type="text" class="form-control" name="waktu" value="<?= $konfirmasi->waktu_konfirmasi ?>">
				                					</div>
				                					<div class="form-group">
				                						<label>Judul</label>
				                						<input type="text" class="form-control" name="judul" value="<?= $konfirmasi->judul ?>">
				                					</div>
				                					<div class="form-group">
				                						<label>Deskripsi</label>
				                						<textarea class="form-control" name="deskripsi" style="height: 150px;"><?= $konfirmasi->deskripsi ?></textarea>
				                					</div>
				                					<div class="form-group">
				                						<label>Bukti Pembayaran</label>
				                						<img src="<?= URL_ ?>img/konfirmasi/<?= $konfirmasi->foto ?>" class="img-responsive">
				                					</div>
				                					<div class="form-group" style="text-align: justify;">
				                						<small>Klik tombol <strong>verifikasi</strong>, untuk merubah status pembayaran menjadi terverifikasi, dan pastikan bahwa anda benar-benar yakin untuk melakukan tindakan ini.</small>
				                					</div>
				                				</div>
				                				<div class="modal-footer">
				                					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				                					<button type="submit" class="btn btn-primary" name="verif" value="<?= $konfirmasi->kode_pemesanan ?>">Verifikasi</button>
				                				</div>
			                				</form>
			                			</div>
			                		</div>
			                	</div>
		                		<?php } ?>
			                	<?php foreach ($pemesanan as $pesanan){ ?>
			                	<div class="modal fade" id="kirim_<?= $pesanan->kode_pemesanan ?>">
			                		<div class="modal-dialog">
			                			<div class="modal-content">
			                				<form action="pesanan/kirim" method="POST">
				                				<div class="modal-header">
				                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                					<h4 class="modal-title"><center>#<?= $pesanan->kode_pemesanan ?></center></h4>
				                				</div>
				                				<div class="modal-body">
				                					<p>Apakah anda yakin ingin merubah status pemesanan menjadi <strong>Terkirim</strong> ?</p>
				                				</div>
				                				<div class="modal-footer">
				                					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				                					<button type="submit" class="btn btn-primary" name="kirim" value="<?= $pesanan->kode_pemesanan ?>">Ya</button>
				                				</div>
			                				</form>
			                			</div>
			                		</div>
			                	</div>
			                	<div class="modal fade" id="batal_<?= $pesanan->kode_pemesanan ?>">
			                		<div class="modal-dialog">
			                			<div class="modal-content">
			                				<form action="pesanan/batal" method="POST">
				                				<div class="modal-header">
				                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                					<h4 class="modal-title"><center>Pembatalan Pesanan #<?= $pesanan->kode_pemesanan ?></center></h4>
				                				</div>
				                				<div class="modal-body">
				                					<p>Apakah anda yakin ingin merubah status pemesanan menjadi <strong>Dibatalkan</strong> ?</p>
				                				</div>
				                				<div class="modal-footer">
				                					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
					                					<button type="submit" class="btn btn-primary" name="batal" value="<?= $pesanan->kode_pemesanan ?>">Ya</button>
				                				</div>
			                				</form>
			                			</div>
			                		</div>
			                	</div>
			                	<div class="modal fade" id="detail_<?= $pesanan->kode_pemesanan ?>">
			                		<div class="modal-dialog">
			                			<div class="modal-content">
			                				<div class="modal-header">
			                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                					<h4 class="modal-title"><center>Detail Pesanan #<?= $pesanan->kode_pemesanan ?></center></h4>
			                				</div>
			                				<div class="modal-body">
			                					<?php /*foreach($detail->result() as $dtl) {
			                						echo $dtl->kode_barang." | "$dtl->nama_barang."<br>";
			                					} */
			                					?>
			                				</div>
			                				<div class="modal-footer">
			                					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                					<button type="button" class="btn btn-primary">Save changes</button>
			                				</div>
			                			</div>
			                		</div>
			                	</div>
			                	<?php } ?>
			           		</tbody>
		           		</table>
	           	</div>
	        </div>
	    </div>
	</div>
	<?php 
	$this->load->view('admin/include/footer');
	$this->load->view('admin/include/js'); 
	?>
	<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.pesanan').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ],
	            "processing": true,
	            "serverSide": true,
	            "bInfo": false,
	            "bFilter": true,
	            "ajax": {
	            	"url" : "<?=base_url()?>admin/pesanan/dataJson",
	            	"type" : "POST"
	            }

            });
            $(".search_form").hide();

	        $(".btn_form_search").click(function(){
	            $('.search_form').slideToggle('slow');
	        });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>
</body>
</html>