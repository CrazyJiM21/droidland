<?php

function Phones_getAllVersions()
{
    $sql = "SELECT phone_android FROM phone GROUP BY phone_android";
    return Sql_query($sql);
}

function Phones_getByID($id)
{
    $sql = "SELECT * FROM phone WHERE id = " . $id;
    return Sql_query($sql)[0];
}
