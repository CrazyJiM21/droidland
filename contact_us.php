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
?>
<div class="content">
 	<!--<div class="main_cat ">
		<div class="games b_sh t_sh"><a href="#">Games</a></div>
		<div class="programs b_sh t_sh"><a href="#">Programs</a></div>
		<div class="wpapers b_sh t_sh"><a href="#">LiveWallpapers</a></div>
		<div class="ringtones b_sh t_sh"><a href="#">Ringtones</a></div>
	</div>
-->
	<div class="about_us">
	<p style="font-size: 15px;">
	email: <b>Kondratiuk2@gmail.com</b>
	</p>
	</div>
</div>
<?php
	include("footer.php");
?>


</div>

</body>
</html>