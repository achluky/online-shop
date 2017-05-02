<?php
	if(isset($_GET['cmd'])){
		if($_GET['cmd']=="logout"){
			session_destroy();
			echo "<meta http-equiv='refresh' content='0,../'>";
		}
	}

?>