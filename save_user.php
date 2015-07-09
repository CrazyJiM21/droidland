<?php
    $login = $_POST['login']; //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    $password = $_POST['password'];  //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    $email = $_POST['email'];
    $location = $_POST['location'];
 
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
 
    $login = trim($login);
    $password = trim($password);
    $email = trim($email);


    if (!empty($_FILES['avatar'])) //проверяем, отправил    ли пользователь изображение
    {
        $avatar=$_FILES['avatar']['name'];
        $avatar = trim($avatar);
        if ($avatar =='' or empty($avatar)) {
            unset($avatar);// если переменная $avatar пуста, то удаляем ее
        }
    }          
    if(!isset($avatar) or empty($avatar) or $avatar ==''){
        $art_img = "images/users/no-avatar.png"; //можете    нарисовать net-avatara.jpg или взять в исходниках
    }          
    else {
        $path_to_users_directory = 'images/users/';
        if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['avatar']['name']))//проверка формата исходного изображения
        {                 
            $filename = $_FILES['avatar']['name'];
            $source = $_FILES['avatar']['tmp_name']; 
            $target = $path_to_users_directory . $filename;
            move_uploaded_file($source,$target);
            if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
                $im    = imagecreatefromgif($path_to_users_directory.$filename) ; //если оригинал был в формате gif, то создаем    изображение в этом же формате. Необходимо для последующего сжатия
            }
            if(preg_match('/[.](PNG)|(png)$/',    $filename)) {
                $im =    imagecreatefrompng($path_to_users_directory.$filename) ;//если    оригинал был в формате png, то создаем изображение в этом же формате.    Необходимо для последующего сжатия
            }
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
                $im =    imagecreatefromjpeg($path_to_users_directory.$filename); //если оригинал был в формате jpg, то создаем изображение в этом же    формате. Необходимо для последующего сжатия
            }           
    //СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ ВЗЯТО С САЙТА www.codenet.ru           
    // Создание квадрата 90x90
    // dest - результирующее изображение 
    // w - ширина изображения 
    // ratio - коэффициент пропорциональности           
            $w = 150;  //200x200. Можно поставить и другой размер.          
            $h = 150;
    // создаём исходное изображение на основе 
    // исходного файла и определяем его размеры 
            $w_src    = imagesx($im); //вычисляем ширину
            $h_src    = imagesy($im); //вычисляем высоту изображения
    // создаём пустую квадратную картинку 
    // важно именно truecolor!, иначе будем иметь 8-битный результат 
            $dest = imagecreatetruecolor($w,$h);           
    // вырезаем квадратную серединку по x, если фото горизонтальное 
            if    ($w_src>$h_src) 
                imagecopyresampled($dest, $im, 0, 0,
                    round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                    0, $w, $h,    min($w_src,$h_src), min($w_src,$h_src));           
    // вырезаем    квадратную верхушку по y, 
    // если фото    вертикальное (хотя можно тоже серединку) 
            if    ($w_src<$h_src) 
            imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h,
                min($w_src,$h_src),    min($w_src,$h_src));           
    // квадратная картинка масштабируется без вырезок 
            if ($w_src==$h_src) 
                imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $w_src);           
            $date=time() + rand();    //вычисляем время в настоящий момент.
            imagejpeg($dest, $path_to_users_directory.$date.".jpg");//сохраняем    изображение формата jpg в нужную папку, именем будет текущее время. Сделано,    чтобы у аватаров не было одинаковых имен.          
    //почему именно jpg? Он занимает очень мало места + уничтожается    анимирование gif изображения, которое отвлекает пользователя. Не очень    приятно читать его комментарий, когда краем глаза замечаешь какое-то    движение.          
            $user_img    = $path_to_users_directory.$date.".jpg";//заносим в переменную путь до аватара. 
            $delfull    = $path_to_users_directory.$filename; 
            unlink($delfull);//удаляем оригинал загруженного    изображения, он нам больше не нужен. Задачей было - получить миниатюру.
        }
        else {
    //в случае несоответствия формата, выдаем соответствующее сообщение
            exit ("Only <strong>JPG,GIF or PNG</strong> is suitable!");
        }
    //конец процесса загрузки и присвоения переменной $avatar адреса    загруженной авы
    }   



    // подключаемся к базе
    include ("admin/bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
    // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
        exit ("Sorry, this login is already exist.");
    }
    // если такого нет, то сохраняем данные
    $result2 = mysql_query ("INSERT INTO users (login,password,email,avatar,location) VALUES('$login','$password','$email','$user_img','$location')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
        exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head>Congratulation! You've registered successfully!</html>");
    }
    else {
        echo "Error! You are not registered!";
    }
?>