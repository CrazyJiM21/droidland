<?php
require __DIR__ . '/../functions/sql.php';

function Articles_getAll()
{
    $sql = "SELECT * FROM articles ORDER BY id_art DESC";
    return Sql_query($sql);
}

function Articles_getAllPaginated($count_on_page, $page = 0)
{
    $count_on_page = 20;
    $start_count_art = (!$page?0:((intval($page)-1)*$count_on_page));
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM articles ORDER BY id_art DESC LIMIT " . $start_count_art . ", " . $count_on_page;
    return Sql_query($sql);
}