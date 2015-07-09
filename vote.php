<?php
    include("admin/bd.php");

$use_cookie = true; //защита от накруток
$expires = 3600*24*31; //время жизни кук в секундах (сейчас установлено 31 день) 

if(isset($_POST['score']) && isset($_POST['vote-id'])){
    $page_id = intval($_POST['vote-id']);   
    $cookie_name = 'page_'.$page_id;
    
    if($use_cookie && isset($_COOKIE[$cookie_name])){
        
        $data['status'] = 'ERR';
        $data['msg'] = 'You\'ve already voted!';
    }
    else{
       
        $result = mysql_query('UPDATE articles SET vote = (vote*voters + '.floatval($_POST['score']).')/(voters + 1), voters = voters + 1 WHERE id_art = '.$page_id);
        if($result == true){

            $data['status'] = 'OK';
            $data['msg'] = 'Thank you!';
            if($use_cookie) {
                setcookie($cookie_name,$page_id,time() + $expires);
            }
        }
        else{        
            $data['status'] = 'ERR';
            $data['msg'] = 'Error!';
        }
    }
}
else{   
    $data['status'] = 'ERR';
    $data['msg'] = 'Not enough data!';
}

echo json_encode($data);
?>
