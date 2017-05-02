<?php
if(isset($_POST['beli_banyak']) || isset($_POST['beli_satu'])){
	/*extract($_POST);
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
	}*/
/*}elseif(isset($_POST['data_pelanggan'])){

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
	}*/
}else{
	echo "<script>window.location='../'</script>";
	exit();
}

?>
