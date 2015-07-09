<!DOCTYPE html>
<html>
<head>
    <title>Android games</title>
    <meta charset="windows-1251">
    
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    
    
</head>
<body> 
<div id="page_align">
<?php 
    include ("header.php");
?>

    <div id="nav"></div>

        <div class="inform " >
            
            
        </div>

<?php
    include("sidebar.php");
?>

<?php
        function search($words) {
            $words = htmlspecialchars($words);
            if ($words === "") 
                return false;
            

            $query_search = "";

            $arraywords = explode(" ", $words);
            foreach ($arraywords as $key => $value) {
                if (isset($arraywords[$key - 1]))
                    $query_search .= ' OR ';
                $query_search .= '`headline` LIKE "%'.$value.'%" OR `content` LIKE "%'.$value.'%"';
            }

            $query = "SELECT * FROM articles WHERE $query_search";
            $mysqli = @new mysqli('localhost', 'root', '', 'droidland');
            $result_set = $mysqli->query($query);
            $mysqli->close();
            $i = 0;

            while ($row = $result_set->fetch_assoc()) {
                $results[$i] = $row;
                $i++;
            }
            
            return $results;
        }
       
        if (isset($_POST['bsearch'])) {
            $words = $_POST['words'];
            $results = search ($words);
        }
 ?>







<div class="find_container">
<?php
    include("admin/bd.php");
    printf('<div class="find_title">');
    if (isset($_POST['bsearch'])){
        echo "<span>Finding results: </span>";

    printf('</div>
        <div class="find_result">');
            if ($results === false) 
                echo "napishi che epta!!!";
            if (count($results) == 0) 
                echo "netu nihuya!";
            else
                for ($i = 0; $i < count($results); $i++){
                    $query = sprintf("SELECT * FROM ratings WHERE id = %s", $results[$i]['id_art']);
                    $result2 = mysql_query($query,$db);
                    $rating = mysql_fetch_array($result2) or die(mysql_error());
                    printf('
                    <div class="back b3radius">
                    <a href="index.php?art_id=%s&cat=%s">   
                        <div id="c_block">
                            <div class="img b3radius">
                            <img src="%s">
                            </div>
                            <div class="c_name_header"><h2>%s</h2>
                        </div>
                         <div class="company">
                                 <span>%s</span>
                        </div>
                        <div class="c_f1">
                            <div class="rating1"><span></span>%s / 5</div>
                        </div>
                        </div>
                    </a>
                    </div>
                    ',$results[$i]['id_art'], $results[$i]['category'], $results[$i]['image'], $results[$i]['headline'], $results[$i]['name_company'], $rating['total_value']
                    );
                }
    }
?>
</div>
</div>
















<?php
include("footer.php");
?>


</div>

</body>
</html>