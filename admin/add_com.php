<?php
    session_start();
    if (isset($_POST['name'])) { $name=$_POST['name'];}
    if (isset($_POST['text'])) { $text = $_POST['text'];}

    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);
    $name = trim($name);
    $text = trim($text);
	
	$text = mysql_real_escape_string($text);

    // подключаемся к базе
    include ("bd.php");
    $date = date("d.m.Y h:i a");
    $art_id = $_GET['art_id'];
	$result1 = mysql_query("SELECT * FROM articles WHERE id_art=$art_id", $db) or die(mysql_error());
	$article = mysql_fetch_array($result1);
	$category = $article['category'];
    $result2 = mysql_query("INSERT INTO comments (id_art, name,`text`,`date`) 
                            VALUES('$art_id', '$name', '$text', '$date')") or die(mysql_error());
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE'){
        echo "<html><head><meta http-equiv='Refresh' content='1; URL=/$category/art$art_id'></head><body>Your comment is successfully added! You will be redirected after 1 seconds. If you don't want to wait click here: <a href='/$category/art$art_id'>Return to the article</a></body></html>";
    }
    else {
        echo "Error!";
    }
?>