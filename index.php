<?php
	session_start();
    require __DIR__ . '/functions/sql.php';
    require __DIR__ . '/controllers/ArticlesController.php';

    getAllArticles();

    include __DIR__ . '/views/index.php';

?>