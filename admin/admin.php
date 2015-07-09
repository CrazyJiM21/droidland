<?php
    session_start();
    include ("bd.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="../js/jquery-2.0.3.min.js"></script>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
	function slideNewArtDiv(){ $('#new_art').slideToggle("slow"); }
	function slideNewCatDiv(){ $('#new_cat').slideToggle("slow"); }
	function slideAllUsersDiv(){ $('#all_users').slideToggle("slow"); }

	function slidePrograms(){ $('#Programs').slideToggle(500); }
	function slideWpapers(){ $('#Wpapers').slideToggle(500); }
	function slideGames(){ $('#Games').slideToggle(500); }
    function slideBooks(){ $('#Books').slideToggle(500); }
	</script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js">
    </script>
	
	<script>
		function showUser(str) {
			if (str=="") {
				document.getElementById("subcat").innerHTML="";
				return;
			} 
			if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("subcat").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","getsubcat.php?cat="+str,true);
			xmlhttp.send();
		}
	</script>

    <style type="text/css">
    .delete {
        background: url("image/delete.png") no-repeat;
        background-size: 50px auto;
    }
    </style>

</head>
<body>

<div class="user_panel">

<?php if(isset($_SESSION['id'])){echo "<strong>Hello, {$_SESSION['login']}!</strong>";}?>
<?php
    if($_SESSION['id'] == 1){
print <<<HERE
    <input type="button" value="New Article" onclick="slideNewArtDiv();">
    <input type="button" value="New Category" onclick="slideNewCatDiv();">
    <input type="button" value="All articles" onclick="slideAllUsersDiv();">
HERE;
}
?>
<div class="m_p">
<a href="/">Main page</a>
</div>
</div>


<!-- NEW ARTICLE -->


<div id="control_panel" style="margin: 0px auto; width: 1100px; padding: 20px; background: #fff; box-shadow: 0px 1px 2px rgba(0,0,0,0.3)">
<div id="new_art" style="display: none;">
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
    <select size="1" name="category" onchange="showUser(this.value)">
<?php
    $result = mysql_query("SELECT * FROM categories",$db);
    $categories = mysql_fetch_array($result);
	echo "<option selected disabled>Choose category...</option>";
    if (!empty($categories['id_cat'])) {
        do {
            $name = $categories['name'];
            printf("
                 <option value='%s'>%s</option>
                 ", $categories['translit'], $categories['name']);
        }
        while($categories = mysql_fetch_array($result));
    }
?>
    </select>
</p>
<p id="subcat">
    <label>Subcategory:<br></label>
		<select disabled size="1" name="sub_category">
			<option selected disabled>Choose a category first!</option>
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
    <label>Link:<br></label>
    <input name="link" type="text" size="100" maxlength="200" required>
</p>

<p>
    <input type="submit" name="submit" value="Submit">
    <input type="reset">
</p>
</form>
</div>


<!-- NEW CATEGORY -->

<div id="new_cat" style="display: none;">
	
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

</div>


<!-- ALL ARTICLES -->

<?php
    function deleteDir($arg){
        $d=opendir($arg);
        while($f=readdir($d)){
            if($f!="."&&$f!=".."){
                if(is_dir($arg."/".$f))
                    delete($arg."/".$f);
                else 
                    unlink($arg."/".$f);
            }
        }
        closedir($d);
        rmdir($arg);
    }

    if(isset($_POST['delbutton'])){
        $id_art = $_POST['id_art'];
        echo '<script type="text/javascript">';
        echo 'var conf = confirm("Do you really want to delete this article?");';
        echo '</script>';
    }

    if (!isset($_GET['conf'])){
        $adding = $_POST['id_art'];
        $getart = "Hello, World!";
        echo '<script type="text/javascript">';
        echo 'var idArt = '.$adding.';';
        echo 'document.location.href="' . $_SERVER['REQUEST_URI'] . '?conf=" + conf + "&id_art=" + idArt;';
        echo '</script>';
    }
    elseif($_GET['conf'] == "true"){

        $id = $_GET['id_art'];

        $sql = sprintf("SELECT headline, image, pics FROM articles WHERE id_art=%s", $id);
        $result = mysql_query($sql, $db);
        $images = mysql_fetch_array($result);

        $title = $images['headline'];
        $folder = str_replace(' ', '_', $title);
        $folder = str_replace(':', '', $folder);
        $folder = str_replace('!', '', $folder);
        $path_to_gallery = "../images/galleries/$folder";
        deleteDir($path_to_gallery);

        if($images['image'] != "../images/articles/no-image.png")
			unlink($images['image']);

        $sql1 = sprintf("DELETE FROM articles WHERE id_art=%s", $id);
        $result1 = mysql_query($sql1, $db);

        $sql2 = sprintf("DELETE FROM ratings WHERE id=%s", $id);
        $result2 = mysql_query($sql2, $db);

        if($result1 && $result2){
            echo "<h2>SUCCESS!</h2>";
        }
        else{
            echo "<h2>FUCK YOU SON OF A BITCH!</h2>";
        }
    }
    else
        echo "<h2>FUCK YOU SON OF A BITCH!</h2>";
?>

<div id="all_users" style="display: none;">
	<h1>All articles</h1>
    <table border="1" cellpadding="15" cellspacing="0" width="100%">
        <thead>
            <th>Title</th>
            <th width="8%">Edit</th>
            <th width="8%">Delete</th>
        </thead>
    <?php 
        $result1 = mysql_query("SELECT * FROM categories", $db);
		$categories = mysql_fetch_array($result1);
		do {
		$category = $categories['translit'];
		echo "<thead><th colspan='3'><button onclick='slide$category();'>$category</button></th></thead>";
		echo "<tbody id='$category' style='display: none;'>";
		$sql = sprintf("SELECT headline, id_art FROM articles WHERE category='%s' ORDER BY headline ASC", $category);
		$result2 = mysql_query($sql,$db);
        $articles = mysql_fetch_array($result2);
        if (!empty($articles['id_art'])) {
            do {
            $title = $articles['headline'];
            $id = $articles['id_art'];
            printf("
				<tr>
                    <td>%s</td>
                    <td><a href='edit_art.php?art_id=%s'><img width='50' src='image/edit.png'></a></td>
                    <td><form method='post' action='admin.php'>
                        <select name='id_art' size='0' style='display: none;'>
                            <option value='%s' selected='selected'>
                        </select>
                        <button type='submit' name='delbutton'><img width='50' src='image/delete.png'></button></form></td>
                </tr>
                 ", $title, $id, $id);
            }
            while($articles = mysql_fetch_array($result2));
        }
		echo "</tbody>";
		}
		while($categories = mysql_fetch_array($result1));
    ?>
    </table>
</div>

</div>
<div class="b">
</div>
</body>
</html>