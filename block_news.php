<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<body>
<div class="block_news ">
                       
<?php
 $result1 = mysql_query("SELECT * FROM articles WHERE category = 'News' ORDER BY 'id_art' DESC",$db);
    $articles = mysql_fetch_array($result1);
    if (!empty($articles['id_art'])) {
        do {
            $content = $articles['content'];
            $headline = $articles['headline'];
            $image = $articles['image'];
            printf('
                    <div class="b_n">
	                        <a href="index.php?art_id=%s">
                                 <h2>%s</h2> 
	                        <a href="index.php?art_id=%s">
                                 <img src="%s"></a>
                            <div class="bn_text">
                                 <p>%s</p>
                            </div>	
                    </div>                   
', $articles['id_art'], $articles['headline'], $articles['id_art'], $articles['image'], $articles['content']
                  );
            }
            while($articles = mysql_fetch_array($result1));
}
?>
 
                    </div>
</body>
</html>