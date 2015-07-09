<?php
	session_start();
    require __DIR__ . '/functions/lib.php';
    require MODELS_ROOT . '/Articles.php';
    require FUNCTIONS_ROOT . '/sql.php';

    $params = [];
    parse_str($_SERVER['QUERY_STRING'], $params);
    if (!empty($params['page'])) {
        $articles = Articles_getPart($params['page']);
    } else {
        $articles = Articles_getPart();
    }
    include VIEWS_ROOT . '/index.php';
?>