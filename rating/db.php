<?php
header("Cache-Control: no-cache");
header("Pragma: nocache");
require('confrate.php');
$rating_tableName = 'ratings'; // название таблицы
$rating_path_db = '';
$rating_path_rpc = '';
$rating_unitwidth = 30;
$rating_conn = mysql_connect($database_host, $database_username, $database_password) or die('Error connecting to mysql');

mysql_query("set character_set_client='utf8'");
mysql_query("set character_set_results='utf8'");
mysql_query("set collation_connection='utf8_general_ci'"); 

$vote_sent = preg_replace("/[^0-9]/", "", $_REQUEST['j']);

setlocale(LC_ALL, "ru_RU.UTF-8"); 

$id_sent = htmlspecialchars($_REQUEST['q']);

$ip_num = preg_replace("/[^0-9\.]/", "", $_REQUEST['t']);
$units = preg_replace("/[^0-9]/", "", $_REQUEST['c']);
$ip = $_SERVER['REMOTE_ADDR'];
$referer = $_SERVER['HTTP_REFERER'];
if ($vote_sent > $units) die("Sorry, vote appears to be invalid.");
$query = mysql_query("SELECT total_votes, total_value, used_ips FROM ".$database_name.".".$rating_tableName." WHERE id='".$id_sent."' ") or die(" Error: " . mysql_error());
$numbers = mysql_fetch_assoc($query);
$checkIP = unserialize($numbers['used_ips']);
$count = $numbers['total_votes'];
$current_rating = $numbers['total_value'];
$sum = $vote_sent + $current_rating;
$tense = ($count == 1) ? "vote" : "votes";
($sum == 0 ? $added = 0 : $added = $count + 1);
((is_array($checkIP)) ? array_push($checkIP, $ip_num) : $checkIP = array($ip_num));
$insertip = serialize($checkIP);
$voted = mysql_num_rows(mysql_query("SELECT used_ips FROM ".$database_name.".".$rating_tableName." WHERE used_ips LIKE '%" . $ip . "%' AND id='" . $id_sent . "' "));
if (!$voted)
{
		if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num))
		{
				$update = "UPDATE ".$database_name.".".$rating_tableName." SET total_votes='" . $added . "', total_value='" . $sum . "', used_ips='" . $insertip . "' WHERE id='".$id_sent."'";
				$result = mysql_query($update);
		}
		header("Location: ".$referer."");
		exit;
}
?>