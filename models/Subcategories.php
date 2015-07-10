<?php

function Subcategories_getAll()
{
    $sql = "SELECT * FROM sub_category ORDER BY id_sub_cat DESC";
    return Sql_query($sql);
}

function Subcategories_getByID($id)
{
    $sql = "SELECT * FROM sub_category WHERE id_sub_cat = " . $id;
    return Sql_query($sql)[0];
}

function Subcategories_getBySuperCat($super_category)
{
    $sql = "SELECT * FROM sub_category WHERE super_cat = '" . $super_category . "'";
    return Sql_query($sql);
}

