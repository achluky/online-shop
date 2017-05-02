<?php
    session_start();
    include "koneksi.php";

    if(isset($_SESSION['username'])){
        $username = mysqli_real_escape_string($GLOBALS['mysqli'],$_SESSION['username']);
        $sql = "SELECT *FROM login WHERE username='$username'";
        if(JumlahData($sql)==0){
            echo "<meta http-equiv='refresh' content='0,../'>";
        	exit();
        }
    }else{
    	echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
        exit();
    }
?>