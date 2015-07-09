<?php
	session_start();
    require __DIR__ . '/models/Articles.php';

    $articles = Articles_getAll();

    include __DIR__ . '/views/index.php';

?>