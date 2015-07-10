<?php
	session_start();
    require __DIR__ . '/functions/const.php';
    require FUNCTIONS_ROOT . '/lib.php';
    require FUNCTIONS_ROOT . '/sql.php';
    require MODELS_ROOT . '/Articles.php';
    require CONTROLLERS_ROOT . '/ArticlesController.php';

    include VIEWS_ROOT . '/index.php';
?>