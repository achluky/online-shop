<?php
	if(!isset($_GET['action'])){
		control('view');
	}else{
		control($_GET['action']);
	}

	function control($action){
		switch ($action) {
			case 'view':
				include "profil-list.php";
				break;
			case 'edit':
				# code...
				break;
			default:
				include "profil-list.php";
				break;
		}
	}
?>