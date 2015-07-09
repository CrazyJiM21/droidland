<?php
    $result_found_rows = mysql_query("SELECT FOUND_ROWS() as `count`", $db);
	$count = mysql_fetch_assoc($result_found_rows);
    if (!empty($articles)) {
        foreach ($articles as $article) {
            $content = $article['content'];
            $headline = $article['headline'];
            $query = sprintf("SELECT * FROM ratings WHERE id = %s", $article['id_art']);
            $result2 = mysql_query($query,$db);
            $rating = mysql_fetch_array($result2);
            echo '
			    <div class="back b3radius">
			        <a href="' . $article['category'] . '/art' . $article['id_art'] . '">
			            <div id="c_block">
			                <div class="img b3radius">
			                    <img width="100%%" src="' . $article['image'] . '">
			                </div>
			                <div class="c_name_header"><h2>'. $article['headline'] . ' </h2>
			                </div>
			                <div class="c_f">
			                <div class="rating1"><span>Rating<br></span> ' . $rating['total_value'] . ' / 5</div>
			                </div>
			                <div class="company">
			                    <span>' . $article['name_company'] . '</span>
			                </div>
			            </div>
			        </a>
			    </div>
			';
		}
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