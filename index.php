<?php
	session_start();
    require __DIR__ . '/functions/const.php';
    require MODELS_ROOT . '/Articles.php';
    require FUNCTIONS_ROOT . '/sql.php';

    $params = [];
    parse_str($_SERVER['QUERY_STRING'], $params);

    $articles = Articles_getPart(!empty($params['page']) ? $params['page'] : 0);

    include VIEWS_ROOT . '/index.php';
?>