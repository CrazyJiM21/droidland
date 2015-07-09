<?php
    session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Android games</title>
	<meta charset="windows-1251">
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    
    
</head>
<body> 
<div id="page_align">
<?php 
	include ("header.php");
?>

	<div id="nav"></div>

		<div class="inform " >
            
            
		</div>

<?php
	include("sidebar.php");

	$query = sprintf("SELECT * FROM users WHERE id = %s", $_SESSION["id"]);
	$result = mysql_query($query, $db);
	$profile = mysql_fetch_array($result);

	$loc = $profile['location'];
	$result2 = mysql_query("SELECT * FROM countries WHERE cc_iso = '$loc'", $db);
	$country = mysql_fetch_array($result2);

?>
	<div class="user_pr">
		<div class="up_ava">
			<?php					
				printf("<img src='%s' />",$profile['avatar']);
			?>
		</div>
		<div class="pr_info">
			<ul>
				<li>
					<?php					
				printf("<span>%s</span>",$profile['login']);
					?>
				</li>
				<li>email:
					<?php
						printf("<span>%s</span>",$profile['email']);
					?>
				</li>
				<li>location:
					<?php
						printf("<span>%s</span>",$country['country_name']);
					?>
				</li>
				<li>Your comments:
					Comments
					<?php
						//printf("<span>%s</span>",$profile['email']);
					?>
				</li>
				<li>Your android device:
					<?php
						printf("<span>%s</span>",$profile['android_device']);
					?>
				</li>
				<li>Your apps:
					<?php
						printf("<span>%s</span>",$profile['apps']);
					?>
				</li>
			</ul>
			<input type="button" name="b_profile" value="edit profile"> 
		</div>
	</div>
	<?php
include("footer.php");
?>


</div>

</body>
</html>