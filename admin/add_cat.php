<?php
    $title = $_POST['title'];
    $translit = $_POST['translit'];
    $category = $_POST['category'];

    $title = stripslashes($title);
    $title = htmlspecialchars($title);
 
    $title = trim($title);

    $translit = stripslashes($translit);
    $translit = htmlspecialchars($translit);
 
    $translit = trim($translit);
 
    // подключаемся к базе
    include ("bd.php");

    if($category == 'None'){
        $result = mysql_query("INSERT INTO categories (name, translit) VALUES('$title', '$translit')");
        // Проверяем, есть ли ошибки
        if ($result=='TRUE')
        {
            echo "<html><head><meta http-equiv='Refresh' content='1; URL=index.php'></head><body>Article is successfully added! You will be redirected after 5 seconds. If you don't want to wait click here: <a href='index.php'>Main page</a></body></html>";
        }
        else {
            echo "Error!";
        }
    }
    else {
        $result = mysql_query("INSERT INTO sub_category (title, super_cat, translit) VALUES('$title', '$category', '$translit')");
        if ($result=='TRUE')
        {
            echo "<html><head><meta http-equiv='Refresh' content='1; URL=/'></head><body>Article is successfully added! You will be redirected after 1 seconds. If you don't want to wait click here: <a href='/'>Main page</a></body></html>";
        }
        else {
            echo "Error!";
        }
    }
        
?>