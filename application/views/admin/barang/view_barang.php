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
	                <?php $this->load->view('admin/barang/view_input_barang'); ?>
	                <div class="table-responsive">
		                <table class="table table-striped table-bordered table-hover barang" >
			                <thead>
			               		<tr>
	                                <th>No</th>
	                                <th>Aksi</th>
	                                <th>Kode Barang</th>
	                                <th>Nama Barang</th>
	                                <th>Kategori</th>
	                                <th>Harga</th>
	                                <th>Stok</th>
	                            </tr>
			                </thead>
			                <tbody>
			                	<?php foreach ($barang->result() as $brg){ ?>
			                	<div class="modal fade" id="hapus_<?= $brg->kode_barang ?>">
			                		<div class="modal-dialog">
			                			<div class="modal-content">
			                				<div class="modal-header">
			                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                					<h4 class="modal-title">Kode Barang <?= $brg->kode_barang ?></h4>
			                				</div>
			                				<div class="modal-body">
			                					<p>Apakah anda yakin ingin menghapus barang <strong>"<?= $brg->nama_barang ?>"</strong> ?</p>
			                				</div>
			                				<div class="modal-footer">
			                					<form action="barang/delete" method="POST">
				                					<button type="submit" class="btn btn-danger" name="delete" value="<?= $brg->kode_barang ?>">Ya</button>
				                					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			                					</form>
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
            $('.barang').DataTable({
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
	            	"url" : "<?=base_url()?>admin/barang/dataJson",
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