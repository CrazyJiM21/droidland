<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.rating.css"/>
    <link rel="stylesheet" type="text/css" href="/css/styles.css"/>

    <script type="text/javascript" src="/rating/rating.js"></script>
    <link rel="stylesheet" type="text/css" href="/rating/style.css"/>

    <script type="text/javascript" src="/fancybox/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.fancybox-1.2.1.pack.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("a.first").fancybox();
            $("a.two").fancybox();
            $("a.video").fancybox({"frameWidth": 520, "frameHeight": 400});
            $("a.content").fancybox({"frameWidth": 600, "frameHeight": 300});
        });
    </script>

    <script type="text/javascript">
        window.jQuery || document.write('<script type="text/javascript" src="/js/jquery-1.6.2.min.js"><\/script>');
    </script>

    <script type="text/javascript" src="/js/jquery.rating-2.0.js"></script>

    <script type="text/javascript">
        $(function () {
            $('a[rel*=leanModal]').leanModal({top: 200});
        });
    </script>

    <script type="text/javascript">

        $(function () {

            $('#rating_3').rating({
                fx: 'float',
                image: 'images/stars.png',
                loader: 'images/ajax-loader.gif',
                minimal: 0.6,
                url: 'vote.php',

            });
        })
    </script>
</head>

<body>
<div class="content">
    <?php
    $params = [];
    parse_str($_SERVER['QUERY_STRING'], $params);
    $page = !empty($params['page']) ? $params['page'] : 0;

    //$users = Users_getAll();
    if (!empty($params['error']) && $params['error'] == 1) {
        echo "<h1>404 PAGE NOT FOUND!</h1>";
    }

    // ОДНА СТАТЬЯ
    elseif (!empty($params['art_id'])) {
        showOneArticle($params['art_id']);
    }

    //	ПОДКАТЕГОРИЯ
    elseif (!empty($params['subcat'])) {
        $articles = Articles_getPartSubCategory($params['cat'], $params['subcat'], $page);
        $count = count(Articles_getAllSubCategory($params['cat'], $params['subcat']));
        showManyArticles($articles, $params, $count);
    }

    //	КАТЕГОРИЯ
    elseif (!empty($params['cat'])) {
        $articles = Articles_getPartCategory($params['cat'], $page);
        $count = count(Articles_getAllCategory($params['cat']));
        showManyArticles($articles, $params, $count);
    }

    //	ВСЕ СТАТЬИ
    else {
        $articles = Articles_getPart($page);
        $count = count(Articles_getAll());
        showManyArticles($articles, $params, $count);
    }

    unset($articles);
    unset($_SESSION['all']);
    ?>
</div>
</div>
</body>
</html>