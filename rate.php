<?php
	session_start();
	include('admin/bd.php');

	if ($_GET['rate'] == 'plus') {
		$query = sprintf("UPDATE articles SET rating = rating + 1 WHERE id_art = '%s'",$_GET['art_id']);
		$result = mysql_query($query);
	}
	else if ($_GET['rate'] == 'minus') {
		$query = sprintf("UPDATE articles SET rating = rating - 1 WHERE id_art = '%s'",$_GET['art_id']);
		$result = mysql_query($query);
	}
	$URL = printf("<html><head><meta    http-equiv='Refresh' content='0; URL=index.php?art_id=%s'></head></html>",$_GET['art_id']);
	exit($URL);


?>