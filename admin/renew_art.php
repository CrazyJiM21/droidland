<?php
    function rearrange( $arr ){
        foreach( $arr as $key => $all ){
            foreach( $all as $i => $val ){
                $new[$i][$key] = $val;    
            }    
        }
        return $new;
    }

    // подключаемся к базе
    session_start();
    include("bd.php");

    $title = $_POST['title'];
    if (isset($_POST['content'])) { $content=$_POST['content'];}
    if (isset($_POST['category'])) { $category = $_POST['category'];}
    if (isset($_POST['sub_category'])) { $sub_category = $_POST['sub_category'];}
    if (isset($_POST['company_name'])) { $company_name = $_POST['company_name'];}
    if (isset($_POST['version'])) { $version = $_POST['version'];}
    if (isset($_POST['size'])) { $size = $_POST['size'];}
    if (isset($_POST['link'])) { $link = $_POST['link'];}


    $title = stripslashes($title);
    $title = htmlspecialchars($title);
    $company_name = stripslashes($company_name);
    $company_name = htmlspecialchars($company_name);
    $version = stripslashes($version);
    $version = htmlspecialchars($version);
    $size = stripslashes($size);
    $size = htmlspecialchars($size);
 
    $title = trim($title);
    $company_name = trim($company_name);
    $version = trim($version);
    $size = trim($size);
    $link = trim($link);
    
    $art_id = $_GET['art_id'];
    $resim = mysql_query("SELECT image, pics FROM articles WHERE id_art = '$art_id'",$db);
    $pictures = mysql_fetch_array($resim);
    $image = $pictures['image'];
    $gallery = $pictures['pics'];

    if (!empty($_FILES['fupload'])) //проверяем, отправил    ли пользователь изображение
    {
        $fupload=$_FILES['fupload']['name'];
        $fupload = trim($fupload); 
        if ($fupload =='' or empty($fupload)) {
            unset($fupload);// если переменная $fupload пуста, то удаляем ее
        }
    }          
    if(!isset($fupload) or empty($fupload) or $fupload ==''){
        $art_img = $image; //можете    нарисовать net-avatara.jpg или взять в исходниках
    }          
    else {
        if($image != "../images/articles/no-image.jpg")
            unlink($image);
        $path_to_90_directory = '../images/articles/';
        if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))//проверка формата исходного изображения
        {                 
            $filename = $_FILES['fupload']['name'];
            $source = $_FILES['fupload']['tmp_name']; 
            $target = $path_to_90_directory . $filename;
            move_uploaded_file($source,$target);
            if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
                $im    = imagecreatefromgif($path_to_90_directory.$filename) ; //если оригинал был в формате gif, то создаем    изображение в этом же формате. Необходимо для последующего сжатия
            }
            if(preg_match('/[.](PNG)|(png)$/',    $filename)) {
                $im =    imagecreatefrompng($path_to_90_directory.$filename) ;//если    оригинал был в формате png, то создаем изображение в этом же формате.    Необходимо для последующего сжатия
            }
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
                $im =    imagecreatefromjpeg($path_to_90_directory.$filename); //если оригинал был в формате jpg, то создаем изображение в этом же    формате. Необходимо для последующего сжатия
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
            $date=time();    //вычисляем время в настоящий момент.
            imagejpeg($dest, $path_to_90_directory.$date.".jpg");//сохраняем    изображение формата jpg в нужную папку, именем будет текущее время. Сделано,    чтобы у аватаров не было одинаковых имен.          
    //почему именно jpg? Он занимает очень мало места + уничтожается    анимирование gif изображения, которое отвлекает пользователя. Не очень    приятно читать его комментарий, когда краем глаза замечаешь какое-то    движение.          
            //$path = substr($path_to_90_directory, 3);
            $art_img    = $path_to_90_directory.$date.".jpg";//заносим в переменную путь до аватара. 
            $delfull    = $path_to_90_directory.$filename; 
            unlink($delfull);//удаляем оригинал загруженного    изображения, он нам больше не нужен. Задачей было - получить миниатюру.
        }
        else {
    //в случае несоответствия формата, выдаем соответствующее сообщение
            exit ("Only <strong>JPG,GIF or PNG</strong> is suitable!");
        }
    //конец процесса загрузки и присвоения переменной $avatar адреса    загруженной авы
    }   



    if (!empty($_FILES['gallery'])) {
        $file_ary = rearrange($_FILES['gallery']);
        if (!isset($file_ary[0]))
            $pics = $gallery;
        else
    {
        $folder = str_replace(' ', '_', $title);
        $folder = str_replace(':', '', $folder);
        $folder = str_replace('!', '', $folder);
        if(!is_dir("../images/galleries/$folder"))
            mkdir("../images/galleries/$folder");
        $path_to_gallery = "../images/galleries/$folder/";
        $pics = $gallery."!";
        foreach ($file_ary as $file) {
            if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$file['name']))//проверка формата исходного изображения
        { 
            $filename = $file['name'];
            $source = $file['tmp_name'];
            $target = $path_to_gallery . $filename;
            move_uploaded_file($source,$target);
            if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
                $im    = imagecreatefromgif($path_to_gallery.$filename) ; //если оригинал был в формате gif, то создаем    изображение в этом же формате. Необходимо для последующего сжатия
            }
            if(preg_match('/[.](PNG)|(png)$/',    $filename)) {
                $im =    imagecreatefrompng($path_to_gallery.$filename) ;//если    оригинал был в формате png, то создаем изображение в этом же формате.    Необходимо для последующего сжатия
            }
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
                $im =    imagecreatefromjpeg($path_to_gallery.$filename); //если оригинал был в формате jpg, то создаем изображение в этом же    формате. Необходимо для последующего сжатия
            }

            $w_src    = imagesx($im); //вычисляем ширину
            $h_src    = imagesy($im); //вычисляем высоту изображения
            $proportion = $w_src / $h_src;

            $h = 250;
            $w = $h * $proportion;

            $dest = imagecreatetruecolor($w,$h); 
            $source = imagecreatetruecolor($w_src, $h_src);
            imagecopyresampled($source, $im, 0, 0, 0, 0, $w_src, $h_src, $w_src, $h_src);
            if ($h_src > $h)
                imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $h_src);           
            
            $date=time() + rand();    //вычисляем время в настоящий момент.
            imagejpeg($dest, $path_to_gallery.$date.".jpg");//сохраняем    изображение формата jpg в нужную папку, именем будет текущее время. Сделано,    чтобы у аватаров не было одинаковых имен.          
            imagejpeg($source, $path_to_gallery.$date."S.jpg");
    //почему именно jpg? Он занимает очень мало места + уничтожается    анимирование gif изображения, которое отвлекает пользователя. Не очень    приятно читать его комментарий, когда краем глаза замечаешь какое-то    движение.
            //$path = substr($path_to_gallery, 3);
            $pics    =  $pics.$path_to_gallery.$date."!";//заносим в переменную путь до аватара. 
            $delfull    = $path_to_gallery.$filename; 
            unlink($delfull);
        } else echo $file['name'];
        }
        $pics = substr($pics, 0, -1);
    }
    }


    $date = date("d F Y");

    $result = mysql_query("UPDATE articles SET headline='$title', content='$content', name_company='$company_name', art_date='$date', category='$category', sub_category='$sub_category',image='$art_img', size='$size', version='$version', pics='$pics', link='$link' 
                            WHERE id_art='$art_id'");
    // Проверяем, есть ли ошибки
    if ($result=='TRUE')
    {
    echo "<html><head><meta http-equiv='Refresh' content='1; URL=/$category/art$art_id'></head><body>Article is successfully updated! You will be redirected after 1 seconds. If you don't want to wait click here: <a href='/$category/art$art_id'>Main page</a></body></html>";
    }
 else {
    echo "Error!";
    }
?>