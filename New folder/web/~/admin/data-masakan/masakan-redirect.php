<?php
	if(!isset($_GET['action'])){
		control('view');
	}else{
		control($_GET['action']);
	}

	function control($action){
		switch ($action) {
			case 'view':
				include "masakan-list.php";
				break;
			case 'edit':
				# code...
				break;
			default:
				include "masakan-list.php";
				break;
		}
	}
?>