<?php
	session_start();
	if($_SESSION['id'] == 1){
		$_SESSION['all'] = "tra";
		echo "<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head><body></body></html>";
	}
?>