<?php

function paginate($params, $count)
{
    echo '<div class="pagination">';
    $curr = (empty($params['page']) ? 1 : intval($params['page']));
    $category = (empty($params['cat']) ? '' : $params['cat'] . '/');
    $sub_category = (empty($params['subcat']) ? '' : $params['subcat'] . '/');

    if (intval($count)%ARTICLES_ON_PAGE != 0){
        for ($i=0; $i<=intval($count)/ARTICLES_ON_PAGE; $i++){
            if($i+1 == $curr)
                printf('<a class="curr_page" href="%s%spage%s">%s</a>', $category, $sub_category, $i+1, $i+1);
            else
                printf(' <a href="%s%spage%s">%s</a> ', $category, $sub_category, $i+1, $i+1);
        }
    }
    else{
        for ($i=0; $i<intval($count)/ARTICLES_ON_PAGE; $i++){
            if($i+1 == $curr)
                printf('<a class="curr_page" href="%s%spage%s">%s</a>', $category, $sub_category, $i+1, $i+1);
            else
                printf(' <a href="%s%spage%s">%s</a> ', $category, $sub_category, $i+1, $i+1);
        }
    }
    echo "</div>";
}