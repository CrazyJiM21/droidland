<?php
	$count_on_page = 20;
    $start_count_art = (empty($_GET['page']))?0:((intval($_GET['page'])-1)*$count_on_page);
    $sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM articles ORDER BY id_art DESC LIMIT %s, %s", $start_count_art, $count_on_page);
    $result1 = mysql_query($sql,$db);
    $articles = mysql_fetch_array($result1);
    $result_found_rows = mysql_query("SELECT FOUND_ROWS() as `count`", $db);
	$count = mysql_fetch_assoc($result_found_rows);
    if (!empty($articles['id_art'])) {
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
			', $articles['category'], $articles['id_art'], $articles['image'],  $articles['headline'], $rating['total_value'], $articles['name_company']
			);
		}
        while($articles = mysql_fetch_array($result1));
		echo "<div class='pagination'>";
		
		// Крутой ПАГИНАТОР	
		
		$curr = (empty($_GET['page']) ? 1 : intval($_GET['page']));
		/*
			$last_page = $count['count'] / $count_on_page;
			$left_limit = 4;
			$right_limit = 5;
			
			makePager($curr, $last_page, $left_limit, $right_limit);
		*/
		if (intval($count['count'])%$count_on_page != 0){
			for ($i=0; $i<=intval($count['count'])/$count_on_page; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='page%s'>%s</a>", $i+1, $i+1);
				else
				printf("<a href='page%s'>%s</a>", $i+1, $i+1);
			}
		}
		else{
			for ($i=0; $i<intval($count['count'])/$count_on_page; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='page%s'>%s</a>", $i+1, $i+1);
				else
				printf("<a href='page%s'>%s</a>", $i+1, $i+1);
			}
		}	
		echo "</div>";
	}
?>