<?php
    require MODELS_ROOT . '/Ratings.php';

	$count = count(Articles_getAll());

    if (!empty($articles)) {

        foreach ($articles as $article) {
            $rating = Ratings_getByID($article['id_art']);
            include VIEWS_ROOT . '/little_article.php';
		}

		echo "<div class='pagination'>";
		
		// Крутой ПАГИНАТОР	
		
		$curr = (empty($_GET['page']) ? 1 : intval($_GET['page']));

		if (intval($count)%ARTICLES_ON_PAGE != 0){
			for ($i=0; $i<=intval($count)/ARTICLES_ON_PAGE; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='page%s'>%s</a>", $i+1, $i+1);
				else
				printf("<a href='page%s'>%s</a>", $i+1, $i+1);
			}
		}
		else{
			for ($i=0; $i<intval($count)/ARTICLES_ON_PAGE; $i++){
				if($i+1 == $curr)
				printf("<a class='curr_page' href='page%s'>%s</a>", $i+1, $i+1);
				else
				printf("<a href='page%s'>%s</a>", $i+1, $i+1);
			}
		}	
		echo "</div>";
	}
?>