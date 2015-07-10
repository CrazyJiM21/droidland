<?php
	$ARTICLES_ON_PAGE = 20;
    $start_count_art = (empty($_GET['page']))?0:((intval($_GET['page'])-1)*$ARTICLES_ON_PAGE);
	$query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM articles WHERE category='%s' ORDER BY id_art DESC LIMIT %s, %s",$_GET['cat'],$start_count_art, $ARTICLES_ON_PAGE);
    $result1 = mysql_query($query,$db);
    $articles = mysql_fetch_array($result1);
	if (!empty($articles['id_art'])) {	
		$result_found_rows = mysql_query("SELECT FOUND_ROWS() as `count`", $db);
		$count = mysql_fetch_assoc($result_found_rows);
        do {
			$content = $articles['content'];
			$headline = $articles['headline'];
			$query = sprintf("SELECT * FROM ratings WHERE id = %s", $articles['id_art']);
			$result2 = mysql_query($query,$db);
			$rating = mysql_fetch_array($result2);
			printf('
			<div class="back b3radius">
			<a href="%s/art%s">
			
			<div id="c_block">
			<div class="img b3radius">
			<img width="100%%" src="%s">
			</div>
			<div class="c_name_header"><h2>%s</h2>
			</div>
			<div class="c_f">
			<div class="rating1"><span>Rating<br></span>%s / 5</div>
			</div>
			<div class="company">
			<span>%s</span>
			</div>
			
			</div>
			</a>
			</div>
			', $articles['category'], $articles['id_art'], $articles['image'], $articles['headline'], $rating['total_value'], $articles['name_company']
			);
		}
		while($articles = mysql_fetch_array($result1));
		$curr = (empty($_GET['page']) ? 1 : intval($_GET['page']));

        echo "<div class='pagination'>";
		if (intval($count['count'])%$ARTICLES_ON_PAGE != 0){
			for ($i=0; $i<=intval($count['count'])/$ARTICLES_ON_PAGE; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='%s/page%s'>%s</a>",$_GET['cat'], $i+1, $i+1);
				else
				printf("<a href='%s/page%s'>%s</a>",$_GET['cat'], $i+1, $i+1);
			}
		}
		else{
			for ($i=0; $i<intval($count['count'])/$ARTICLES_ON_PAGE; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='%s/page%s'>%s</a>",$_GET['cat'], $i+1, $i+1);
				else
				printf("<a href='%s/page%s'>%s</a>",$_GET['cat'], $i+1, $i+1);
			}
		}	
		echo "</div>";
	}
	else echo "<h1>404 PAGE NOT FOUND!</h1>";
?>