<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Пример: Скрипт рейтинга на PHP</title>
<script type="text/javascript" src="rating.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>
<?
require('form.php');

$userrating="rche.ru"; // имя пользователя за кооторого голосуем, или ID

echo rating_bar($userrating,5);
?>
<br/>
<a href="http://rche.ru/303_skript-dlya-reitinga.html">Описание скрипта рейтинга</a>
</body>
</html>