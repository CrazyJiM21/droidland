<?php include ("bd.php"); ?>
<!DOCTYPE html>
<html>
    <head>
    <title>New article</title>
    <style type="text/css">
       body {background-color:#ddd; color:#fc3a67; font-family: roboto, arial, sans-serif; margin-left: 50px;
}
       h2 {color: #fc3a67; font-weight: bolder; }
</style>
    
    <script type="text/javascript" src="/ckeditor/ckeditor.js">
    </script>
    </head>
    <body>
    <h2>New article</h2>
    <form action="add_art.php" method="post" enctype="multipart/form-data">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <label>Title:<br></label>
    <input name="title" type="text" size="100" maxlength="200" required>
</p>
<p>
    <label>Company name:<br></label>
    <input name="company_name" type="text" size="100" maxlength="200" required>
</p>
<p>
    <label>Version of Android:<br></label>
    <select size="1" name="version">
<?php
    $result = mysql_query("SELECT phone_android FROM phone GROUP BY phone_android",$db);
    $versions = mysql_fetch_array($result);
    if (!empty($versions['phone_android'])) {
        do {
            $version = $versions['phone_android'];
            printf("
                 <option value='%s'>%s</option>
                 ", $version, $version);
        }
        while($versions = mysql_fetch_array($result));
    }
?>
    </select>
</p>
<p>
    <label>Size (Mb):<br></label>
    <input name="size" type="text" size="100" maxlength="200" required>
</p>
<p>
    <label>Category:<br></label>
    <select size="1" name="category">
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
    <label>Sub_Category:<br></label>
    <select size="1" name="sub_category">
<?php
    $result = mysql_query("SELECT * FROM sub_category",$db);
    $subcat = mysql_fetch_array($result);
    if (!empty($subcat['id_sub_cat'])) {
        do {
            $title = $subcat['title'];
            printf("
                 <option value='%s'>%s</option>
                 ", $subcat['title'], $subcat['title']);
        }
        while($subcat = mysql_fetch_array($result));
    }
?>
    </select>
</p>

<p>
    <label>Main image (jpg, gif, png):<br></label>
    <input type="FILE" name="fupload">
</p>
<!-- В переменную fupload отправится изображение, которое выбрал пользователь -->

<p>
    <label>Gallery (jpg, gif, png):<br></label>
    <input name="gallery[]" type="file" multiple /><br /> 
</p>

<p style="width: 650px;">
    <label>Text:</label></br>
    <textarea id="editor1" name="content">
        </textarea>
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1' );
    </script>
</p>
<p>
    <input type="submit" name="submit" value="Submit">
    <input type="reset">
</p>
</form>
</body>
</html>