<?php
date_default_timezone_set("Asia/Jakarta");
//================================================================================
//KONEKSI PDO
$host='localhost';
$user='root';
$pass='';
$db='sayur_potong';
try{
	$GLOBALS['koneksiPdo'] = new PDO("mysql:host={$host}; dbname={$db};",$user,$pass);
}catch(PDOException $exception){
	echo "<script>alert('Terjadi Kesalahan Pada Koneksi DataBase !');</script>";
	exit();
	echo "<script>KONEKSI PDO GAGAL TOTAL !!!</script>". $exception->getMessage();
}
//================================================================================
//================================================================================
//KONEKSI MySQLi
	@$GLOBALS['mysqli'] = mysqli_connect("localhost","root","","sayur_potong");
	if(!mysqli_connect("localhost","root","","sayur_potong")){
		echo "<script>alert('Terjadi Kesalahan Pada Koneksi DataBase !');</script>"; 
		exit();
	}
//================================================================================

function filter($var){
	$variable = mysqli_real_escape_string($GLOBALS['mysqli'],$var);
	return $variable;
}

function JumlahData($query){
	$koneksiPdo = $GLOBALS['koneksiPdo'];
	$jml_data = $koneksiPdo->prepare($query);
	$jml_data -> execute();
	$jml_data = $jml_data->rowCount();

	return $jml_data;
}

function PdoQuery($query){
	$koneksiPdo = $GLOBALS['koneksiPdo'];
	$list = $koneksiPdo->prepare($query);
	$list -> execute();

	return $list;
}

function PdoSelect($query){
	$koneksiPdo = $GLOBALS['koneksiPdo'];
	$list = $koneksiPdo->prepare($query);
	$list -> execute();
	$data = $list->fetch(PDO::FETCH_ASSOC);

	return $data;
}

$data = array(
	array("Kolom 1","Kolom 2","Kolom 3"),
	array("Kolom 1","Kolom 2","Kolom 3"),
	array("Kolom 1","Kolom 2","Kolom 3")
);
$field = array ("nis","nama","pass");

function PdoInput($table,$field,$data){
	$koneksiPdo = $GLOBALS['koneksiPdo'];
	$tmp0 = array();
	$tmp1 = array();
	$tmp2 = array();
	$tmpField0 = "";
	$tmpField1 = "";
	$tmpField2= "";
	$fields1 = "";
	$fields2 = "";

	for($i=0;$i<count($field);$i++){
		if($i==(count($field))-1){
			//$tmp0[$i] = $field[$i];
			$tmp1[$i] = $field[$i];
			$tmp2[$i] = ":".$field[$i]."";
		}else{
			//$tmp0[$i] = $field[$i];
			$tmp1[$i] = $field[$i].",";
			$tmp2[$i] = ":".$field[$i].",";
		}
		//$tmpField0 .= $tmp0[$i];
		$tmpField1 .= $tmp1[$i];
		$tmpField2 .= $tmp2[$i];
		$fields1 .= $tmpField1;
		$fields2 .= $tmpField2;
		//echo "$tmp2[$i]<br>";
		$tmpField1="";
		$tmpField2="";
		$tmpField3="";
	}

	$fields1 = "($fields1)";
	$fields2 = "($fields2)";
	//echo "$fields2";
		$sql = "INSERT INTO $table $fields1 VALUES $fields2";
		$stmt = $koneksiPdo->prepare($sql);
		
		for($i=0;$i<count($data);$i++){		
			for($j=0;$j<count($data[0]);$j++){
				//echo "$field[$j] :  ".$data[$i][$j]."<br>";
				$stmt -> bindParam("$field[$j]", $data[$i][$j]);
			}
			$stmt->execute();
		}
	return $stmt;
}

function PdoUpdate(){
	
}

function mysqlInput($table,$field,$data){
	$koneksiPdo = $GLOBALS['koneksiPdo'];
	$tmpField = array();
	$tmpField2 = "";
	$fields = "";
	$fields2 = "";

	$tmpValue = array();
	$tmpValue2 = "";
	$value = "";

	//Multiple Value
	for($i=0;$i<count($data);$i++){
		for($j=0;$j<count($data[0]);$j++){
			if($j==(count($data[0])-1)){
				$tmpValue[$j] = "'".$data[$i][$j]."'";
			}else{
				$tmpValue[$j] = "'".$data[$i][$j]."',";
			}
			$tmpValue2 .= $tmpValue[$j];
		}

		$tmpValue[$i] = $tmpValue2;
		$tmpValue2="";
		
		if($i==(count($data))-1){
			$tmpValue[$i] = "(".$tmpValue[$i].")";
		}else{
			$tmpValue[$i] = "(".$tmpValue[$i]."),";
		}

		$tmpValue2 .= $tmpValue[$i];
		$value .= $tmpValue2;

		$tmpValue2 ="";
	}

	//Nama Field DataBase
	for($i=0;$i<count($field);$i++){
		if($i==(count($field))-1){
			$tmpField[$i] = $field[$i];
		}else{
			$tmpField[$i] = "".$field[$i].",";
		}

		$tmpField2 .= $tmpField[$i];
		$fields .= $tmpField2;
		$fields2 .= ":".$tmpField2;

		$tmpField2="";
	}

	$fields = "($fields)";
	$fields2 = "($fields2)";
	//echo "$fields<br>$fields2<br> $value";
	//echo "INSERT INTO $table $fields VALUES $value";
	$input = $koneksiPdo->prepare("INSERT INTO $table $fields VALUES $value");
	$input->execute();

	return $input;
}

	@mysql_connect('localhost','root','');
	@mysql_select_db('sayur_potong');
	
	//$sql="select *from login";
	//$hasil=mysql_query($sql);
	//while($data=mysql_fetch_row($hasil)){
	//	echo"$data[0]";
	//}
	
?>