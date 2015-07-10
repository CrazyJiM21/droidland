<?php

function Categories_getAll()
{
    $sql = "SELECT * FROM categories ORDER BY id_cat DESC";
    return Sql_query($sql);
}

function Categories_getByID($id)
{
    $sql = "SELECT * FROM categories WHERE id_cat = " . $id;
    return Sql_query($sql)[0];
}
