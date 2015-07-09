<?php

function Articles_getAll()
{
    $sql = "SELECT * FROM articles ORDER BY id_art DESC";
    return Sql_query($sql);
}

function Articles_getPart($page = 0)
{
    $start_count_art = (!$page?0:((intval($page)-1)*ARTICLES_ON_PAGE));
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM articles ORDER BY id_art DESC LIMIT " . $start_count_art . ", " . ARTICLES_ON_PAGE;
    return Sql_query($sql);
}

function Articles_getByID($id)
{
    $sql = "SELECT * FROM articles WHERE id_art = " . $id;
    return Sql_query($sql)[0];
}