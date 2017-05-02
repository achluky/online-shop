<?php include "../include/koneksi.php" ?>
<?php
	if(isset($_POST['beli_banyak']) || isset($_POST['beli_satu'])){
		extract($_POST);
		$id_masakan = "";
		$jml_pesanan = count($pesanan);
		for($i=0; $i < count($pesanan); $i++){
			if($i == 0){
				$id_masakan = " id_masakan='$pesanan[$i]'";
			}else{
				$id_masakan .= " OR id_masakan='$pesanan[$i]'";
			}
		}
		if($jml_pesanan > 0){
			$empty = false;
		}else{
			$empty = true;
		}
	}elseif(isset($_POST['data_pelanggan'])){
	
		$id_pel=0;
		$no_hp = filter($_POST['no_hp']);
		$nama = filter($_POST['nama']);
		$alamat = filter($_POST['alamat']);

		$tmpId = PdoSelect("SELECT MAX(id_pelanggan) as id_pel FROM pelanggan");
		if($tmpId < 0){
			$id_pel = 1;
		}else{
			$id_pel = $tmpId['id_pel']+1;
		}

		$field_pel = array('id_pelanggan','nama','alamat','no_hp');
		$data_pel = array(array($id_pel,$nama,$alamat,$no_hp));

		//Input Pelanggan
		if(PdoInput("pelanggan",$field_pel,$data_pel)){
			$id_pesanan = 0;
			$tmpPesanan = PdoSelect("SELECT MAX(id_pesanan) as id_pesanan FROM pesanan");
			if($tmpPesanan['id_pesanan'] < 0){
				$id_pesanan = 1;
			}else{
				 $id_pesanan = $tmpPesanan['id_pesanan']+1;
			}
			extract($_POST);
			if(count($idm) > 0){
				$id_masakan = "";
				$total_harga = 0;
				for($i=0; $i < count($idm); $i++){
					$harga_masakan = PdoSelect("SELECT harga FROM masakan WHERE id_masakan='$idm[$i]'");
					$total_harga += ($qty[$i] * $harga_masakan['harga']); 
				}
				$field_pes = array('id_pesanan','id_pelanggan','total_harga');
				$data_pes = array(array($id_pesanan,$id_pel,$total_harga));
				
				//Input Pesanan
				if(PdoInput("pesanan",$field_pes,$data_pes)){
					$field_detail = array('id_detail_pesanan','id_pesanan','id_masakan','jumlah');
					$data_detail = array(array());
					for($i=0; $i<count($idm); $i++){
						$data_detail[$i][0] = "";
						$data_detail[$i][1] = $id_pesanan;
						$data_detail[$i][2] = $idm[$i];
						$data_detail[$i][3] = $qty[$i];
					}
					
					//Input Detail Pesanan
					if(PdoInput("detail_pesanan",$field_detail,$data_detail)){
						echo "<script>alert('Data Tersimpan !'); window.location='?action=pemesanan&id=$id_pesanan#services'</script>";
						exit();
					}
				}
			}else{
				echo "<script>alert('Terjadi Kesalahan !'); window.location='../'</script>";
				exit();
			}
		}
		
	}elseif(isset($_GET['action'])){
		if($_GET['action']=="pemesanan"){
			if(isset($_GET['id'])){
				$empty = true;
				$id_masakan = "";
				$id_pesanan = filter($_GET['id']);
				$q = "SELECT DISTINCT(id_masakan) FROM detail_pesanan WHERE id_pesanan='$id_pesanan'";
				$sql = PdoQuery($q);
				$cek = JumlahData($q);
				$jml_pesanan = $cek;
				if($cek > 0){
					$empty = false;
					$i=0;
					while($pesanan = $sql->fetch(PDO::FETCH_ASSOC)){
						if($i == 0){
							$id_masakan = " id_masakan='$pesanan[id_masakan]'";
						}else{
							$id_masakan .= " OR id_masakan='$pesanan[id_masakan]'";
						}
						$i++;
					}
					$stat = PdoSelect("SELECT status FROM pesanan WHERE id_pesanan='$id_pesanan'");
					$status = $stat['status'];
				}else{
					$empty = true;
				}
			}else{
				echo "<script>window.location='../'</script>";
				exit();
			}
		}else{
			echo "<script>window.location='../'</script>";
			exit();
		}
	}else{
		echo "<script>window.location='../'</script>";
		exit();
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<style type="text/css">
		.devider{
			height: 1px;
		    margin: 9px 0;
		    overflow: hidden;
		    background-color: #e5e5e5;
		}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sayuran Potong</title>
    
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="../css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="padding-bottom:2px; padding-top:5px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Sayuran Potong</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../#portfolio">Masakan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../#contact">Contact</a>
                    </li>
                    <li class="dropdown" style="padding-left: 15px; padding-right: 0px; margin-top:-2px">
                        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;" style="padding:0px;">
	                        <span class="fa-stack fa-2x" title="Pesanan">
                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
	                        </span><strong id="count" style="color: red;"><?php echo $jml_pesanan; ?></strong>
                        </a>
                        <ul class="dropdown-menu" style="overflow: auto; width:400px;">
                			<li style="padding:15px;"><center><strong>DAFTAR PESANAN</strong></center></li>
                			<li class="devider"></li>
		                    <li>
		                    	<table class="table table-hover" style="margin-bottom:0px;">
		                        	<?php
		                        		$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
		                        		$no=1;
		                        		$total = 0;
		                        		while ($list = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
				                            <tr>
				                            	<td style="vertical-align: middle; padding-left:15px;"><?php echo $no++." &nbsp;"; ?></td>
				                            	<td style="vertical-align: middle;"><a href="../img/masakan/<?php echo $list['foto']; ?>" style="color: #5bc0de" target="_blank">
				                            		<img src="../img/masakan/<?php echo $list['foto']; ?>" class="img-circle" style="width:30px; height:30px;">
				                            		</a>
				                            	</td>
				                            	<td style="vertical-align: middle;">&nbsp; <?php echo $list['nama']; ?></td>
				                            	<td style="text-align: right; vertical-align: middle; padding-right:15px;"><?php echo " Rp. $list[harga]";?></td> 
					                        </tr>
		                        		<?php
		                        		$total += $list['harga'];
		                        		}
		                        	?>
		                        </table>
	                        </li>
	                        <li class="devider" style="margin-top:0px;"></li>
                            <li>
                            	<table class="table table-hover" style="margin-bottom:0px;">
			                        <tr>
			                        	<td colspan="2">
			                        		<a class="page-scroll" href="#services">
			                        		<button type="submit" class="btn btn-info" name="beli_banyak" value="true" style="width:100%">
			                        			<span class="glyphicon glyphicon-arrow-down"></span> 
			                        			SELANJUTNYA
			                        		</button>
			                        		</a>
			                        	</td>
			                        </tr>
                            	</table>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <!--<div class="intro-lead-in">Selamat Datang Di Toko Sayuran Potong</div>-->
                <div class="intro-heading">Selamat Datang</div>
                <a class="page-scroll btn btn-xl" href="#services">
        			<span class="glyphicon glyphicon-arrow-down"></span> 
        			Pemesanan
        		</a>
            </div>
        </div>
    </header>

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
                    		$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
                    		$no=1;
                    		$total = 0;
                    		while ($list = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
	                            <tr>
	                            	<td style="vertical-align: middle; padding-left:15px;"><?php echo $no." &nbsp;"; ?></td>
	                            	<td style="vertical-align: middle;"><a href="../img/masakan/<?php echo $list['foto']; ?>" style="color: #5bc0de" target="_blank">
	                            		<img src="../img/masakan/<?php echo $list['foto']; ?>" class="img-circle" style="width:30px; height:30px;">
	                            		</a>
	                            	</td>
	                            	<td style="text-align: left; vertical-align: middle;">&nbsp; <?php echo $list['nama']; ?></td>
	                            	<td style="text-align: right; vertical-align: middle; padding-right:15px;" id="harga_<?php echo $no;?>"><?php echo " Rp. $list[harga]";?></td>
		                        </tr>
                    		<?php
                    		$no++;
                    		$total += $list['harga'];
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
					if(!$empty){?>
            		<button class="btn btn-primary" data-toggle="modal" href='#modal-id'><?php if(isset($_POST['beli_banyak']) && $jml_pesanan > 0) echo"Isi Data"; elseif(!$empty) echo "Lihat Data";?></button>
                	<div class="modal fade" id="modal-id">
                	   	<div class="modal-dialog">
                	   		<div class="modal-content">
                	   			<div class="modal-header">
                	   				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                	   				<h4 class="modal-title">Data Pemesan</h4>
                	   			</div>
                	   			<form action="#services" method="POST">
	                	   			<?php if(isset($_POST['beli_banyak']) && !$empty){ ?>
	                	   				<div class="modal-body" style="text-align:left;">
		            	   					<input type='hidden' name='action' value='pelanggan'>
					                		<div class="form-group">
					                			<label style="float:left;">No. HP</label>
					                			<input type="tel" class="form-control" name="no_hp" placeholder="Contoh : 085789012345" required>
					                		</div>
					                		<div class="form-group">
					                			<label style="float:left;">Nama</label>
					                			<input type="text" class="form-control" name="nama" placeholder="Nama" required>
					                		</div>
					                		<div class="form-group">
					                			<label style="float:left;">Alamat</label>
					                			<textarea class="form-control" name="alamat" style="height:100px" required></textarea>
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
							                    		$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
							                    		$no=1;
							                    		$total = 0;
							                    		while ($list = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
								                            <tr>
								                            	<td style="vertical-align: middle; padding-left:15px;"><?php echo $no." &nbsp;"; ?></td>
								                            	<td style="vertical-align: middle;"><a href="../img/masakan/<?php echo $list['foto']; ?>" style="color: #5bc0de" target="_blank">
								                            		<img src="../img/masakan/<?php echo $list['foto']; ?>" class="img-circle" style="width:30px; height:30px;">
								                            		</a>
								                            	</td>
								                            	<td style="text-align: left; vertical-align: middle;">&nbsp; <?php echo $list['nama']; ?></td>
								                            	<td>
								                            		<input type="hidden" name="idm[]" value="<?php echo $list['id_masakan']; ?>">
								                            		<input type="number" id="quantity" onchange="updateQty(this.value)" class="form-control" min="1" step="1" name="qty[]" style="width: 60px" value="1">
								                            	</td>
								                            	<td style=" vertical-align: middle; padding-right:15px;" id="harga_<?php echo $no;?>"><?php echo " Rp. $list[harga]";?></td>
									                        </tr>
							                    		<?php
							                    		$no++;
							                    		$total += $list['harga'];
							                    		}
							                    	?>
							                    	<tr>
							                        	<td colspan="4" style="text-align: left; vertical-align: middle; padding-left:15px;"><strong><?php echo "TOTAL";?></strong></td> 
							                        	<!--<td id="qty"><?php //echo $jml_pesanan; ?></td>-->
							                        	<td colspan="1" style=" vertical-align: middle; padding-right:15px;"><strong style="color:red"><?php echo "Rp. $total";?></strong></td> 
							                        </tr>
							                        </tbody>
							                    </table>
						                	</div>
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
                                                    <tbody>
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
                                                    </tbody>
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
</body>
    <!-- jQuery -->
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/agency.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>

</body>
	
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
</html>
