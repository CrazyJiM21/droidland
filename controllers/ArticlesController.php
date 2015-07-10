<?php
    require MODELS_ROOT . '/Ratings.php';

function showManyArticles($articles, $params, $count)
{
    if (!empty($articles)) {

        foreach ($articles as $article) {
            $rating = Ratings_getByID($article['id_art']);
            include VIEWS_ROOT . '/little_article.php';
        }

        paginate($params, $count);
    } else {
        echo "<h1>404 PAGE NOT FOUND!</h1>";
    }
}

function showOneArticle($id)
{
    $article = Articles_getByID($id);
    if (!empty($article['id_art'])) {
        include VIEWS_ROOT . '/full_article.php';
    } else {
        echo "<h1>404 PAGE NOT FOUND!</h1>";
    }
}

function showRelatedArticles($sub_category, $id)
{
    $rel_articles = Articles_getRelated($sub_category, $id);
    if (!empty($rel_articles)) {
        foreach ($rel_articles as $rel) {
            include VIEWS_ROOT . '/related_article.php';
        }
    } else {
        echo "<h1>404 PAGE NOT FOUND!</h1>";
    }
}
?>