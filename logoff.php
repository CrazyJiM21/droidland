<?php
  session_start();
  if(empty($_SESSION['login']) or empty($_SESSION['id'])){
    exit ("FUCK YOU! SON OF A BITCH! <a href='index.php'>Main page</a>");
  }
          
  unset($_SESSION['login']); 
  unset($_SESSION['id']);//уничтожаем переменные в сессиях
  exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=/'></head></html>");
  // отправляем пользователя на главную страницу.
?>