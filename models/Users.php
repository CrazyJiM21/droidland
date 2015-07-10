<?php

function Users_getAll()
{
    $sql = "SELECT * FROM users ORDER BY id";
    return Sql_query($sql);
}

function Users_getByID($id)
{
    $sql = "SELECT * FROM users WHERE id = " . $id;
    return Sql_query($sql)[0];
}