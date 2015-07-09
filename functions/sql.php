<?php

function Sql_connect()
{
    mysql_connect ('localhost','root','');
    mysql_select_db ('droidland');
    mysql_query("SET NAMES utf8");
}

function Sql_query($sql)
{
    Sql_connect();
    $res = mysql_query($sql);
    $ret = [];

    while (false !== $row = mysql_fetch_assoc($res)) {
        $ret[] = $row;
    }

    return $ret;
}

function Sql_exec($sql)
{
    Sql_connect();
    mysql_query($sql) or die(mysql_error());
}