<?php

function Ratings_getAll()
{
    $sql = "SELECT * FROM ratings ORDER BY id DESC";
    return Sql_query($sql);
}

function Ratings_getByID($id)
{
    $sql = "SELECT * FROM ratings WHERE id = " . $id;
    return Sql_query($sql)[0];
}
