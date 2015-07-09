<?php
    session_start();
    include ("bd.php");
    $sql = sprintf("SELECT * FROM articles WHERE id_art = '%s'", $_GET['art_id']);
    $result = mysql_query($sql,$db);
    $article = mysql_fetch_array($result);
 ?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="../css/admin.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
    function slideNewArtDiv(){ $('#new_art').slideToggle(500); }
    function slideNewCatDiv(){ $('#new_cat').slideToggle(500); }
    function slideAllUsersDiv(){ $('#all_users').slideToggle(500); }
    </script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js">
    </script>
</head>
<body>
    <h2>Edit article</h2>
    <? printf('<form action="renew_art.php?art_id=%s" method="post" enctype="multipart/form-data">',$_GET['art_id']); ?>
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <label>Title:<br></label>
    <? printf('<input name="title" type="text" size="100" maxlength="200" value="%s" required>',$article['headline']); ?>
</p>
<p>
    <label>Company name:<br></label>
    <? printf('<input name="company_name" type="text" size="100" maxlength="200" value="%s" required>',$article['name_company']); ?>
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
            if($version == $article['version'])
                printf("
                 <option selected='selected' value='%s'>%s</option>
                 ", $version, $version);
            else
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
    <? printf('<input name="size" type="text" size="100" maxlength="200" value="%s" required>',$article['size']); ?>
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
            $translit = $categories['translit'];
            if ($translit == $article['category'])
                printf("
                 <option selected='selected' value='%s'>%s</option>
                 ", $translit, $name);
            else
                printf("
                 <option value='%s'>%s</option>
                 ", $translit, $name);
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
            $translit = $subcat['translit'];
            if ($translit == $article['sub_category'])
                printf("
                 <option selected='selected' value='%s'>%s</option>
                 ", $translit, $title);
            else
                printf("
                 <option value='%s'>%s</option>
                 ", $translit, $title);
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
    <? echo $article['content']; ?>
        </textarea>
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1' );
    </script>
</p>

<p>
    <label>Link:<br></label>
    <? printf('<input name="link" type="text" size="100" maxlength="200" value="%s" required>',$article['link']); ?>
</p>

<p>
    <input type="submit" name="submit" value="Apply changes">
    <input type="reset">
</p>
</form>
</body>
</html>