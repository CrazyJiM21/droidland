<?php include ("bd.php"); ?>
<!DOCTYPE html>
<html>
    <head>
    <title>New category</title>
     <style type="text/css">
       body {background-color:#ddd; color:#fc3a67; font-family: roboto, arial, sans-serif; margin-left: 50px;
}
       h2 {color: #fc3a67; font-weight: bolder; }
</style>
    </head>
    <body>
    <h2>New category</h2>
    <form action="add_cat.php" method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <label>Category:<br></label>
    <select size="1" name="category" required>
        <option selected>None</option>
<?php
    $result = mysql_query("SELECT * FROM categories",$db);
    $categories = mysql_fetch_array($result);
    if (!empty($categories['id_cat'])) {
        do {
            $name = $categories['name'];
            printf("
                 <option value='%s'>%s</option>
                 ", $categories['name'], $categories['name']);
        }
        while($categories = mysql_fetch_array($result));
    }
?>
    </select>
</p>
<p>
    <label>Title:<br></label>
    <input name="title" type="text" size="100" maxlength="200" required>
</p>
<p>
    <label>Transliteration:<br></label>
    <input name="translit" type="text" size="100" maxlength="200" required>
</p>
<p>
    <input type="submit" name="submit" value="Submit">
</p>
</form>
</body>
</html>