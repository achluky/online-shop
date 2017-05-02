<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('include/head'); ?>
    <?php $this->load->view('include/navigation'); ?>
    <?php $this->load->view('include/intro'); ?>
	<body id="page-top" class="index">
	<?php if($is_pelanggan){ ?>
        <form action="pemesanan" method="POST">
    <?php }
    		$this->load->view('include/section_a'); 

            //Daftar Barang
    		$this->load->view('include/section_b');
    	?>
    	<!-- Pembayaran -->
        <div id="pembayaran">
           
        </div>
        <div class="modal fade" id="login" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="signin/cek" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <center><h4 class="modal-title">Login</h4></center>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="registrasi" style="padding-right:10px;" target="_blank" class="btn btn-info">Registrasi</a>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php if($is_pelanggan){ ?>
    </form>
    <?php }
		$this->load->view('include/js'); 
	?>
	</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable();
    } );

    function updateJumlah(checkbox){
        //var j = parseInt(document.getElementById("jumlah"))+1;
        var b = document.getElementById("count").innerHTML;
        var x = parseInt(b);
        var modal =  "<a class='btn btn-primary' data-toggle='modal' href='#modal-login'>Login</a>"+
                "<div class='modal fade' id='modal-login'>"+
            "<div class='modal-dialog'>"+
                "<div class='modal-content'>"+
                    "<form action='signin/cek' method='POST'>"+
                        "<div class='modal-header'>"+
                            "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"+
                            "<h4 class='modal-title'>Login</h4>"+
                        "</div>"+
                        "<div class='modal-body'>"+
                            "<div class='form-group'>"+
                                "<input type='text' name='email' class='form-control' placeholder='Email'>"+
                            "</div>"+
                            "<div class='form-group'>"+
                                "<input type='password' name='password' class='form-control' placeholder='Password'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='modal-footer'>"+
                            "<a href='registrasi' style='padding-right:10px;' target='_blank' class='btn btn-info'>Registrasi</a>"+
                            "<button type='submit' name='login' class='btn btn-primary'>Login</button>"+
                        "</div>"+
                    "</form>"+
                "</div>"+
            "</div>"+
        "</div>";
        var next = "<button type='submit' class='btn btn-info btn-lg' name='beli_banyak' value='true'><span class='glyphicon glyphicon-arrow-right'></span> SELANJUTNYA</button>";
        var button = modal;
        <?php 
        if($is_pelanggan){?>
            button = next;
        <?php
        }
        ?>
        //alert(b);
        if (checkbox.checked){
            if(x == 0){
                document.getElementById("pembayaran").innerHTML="<section id='bayar' style='padding: 100px;'><div class='container'><div class='row'><div class='col-lg-12 text-center'><h2 class='section-heading'>Lengkapi <br>Data Pemesanan</h2><h3 class='section-subheading text-muted'>Apabila anda telah selesai memilih barang, klik tombol <strong>SELANJUTNYA</strong> untuk melakukan proses pemesanan</h3>"+button+"</div><div class='row'><div class='col-lg-12'></div></div></div></div></section><div class='bg-light-gray' style='height: 100px;'></div>";
            }
            x += 1;
            document.getElementById("count").innerHTML = ""+x;
            document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger'></i>";
        }else{
            if(x <= 0){
                x = 0;
            }else{
                x -= 1;
            }
            if(x > 0){
                document.getElementById("count").innerHTML = ""+x;
                document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger'></i>";
            }else{
                document.getElementById("count").innerHTML = "0";
                document.getElementById("pembayaran").innerHTML="";
                document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger' style='color: gray;'></i>";
            }
        }
    }
</script>