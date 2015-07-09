<div class="back b3radius">
    <a href="<?php echo $article['category']; ?>/art<?php echo $article['id_art'];?>">
        <div id="c_block">
            <div class="img b3radius">
                <img width="100%%" src="<?php echo $article['image'];?>">
            </div>
            <div class="c_name_header"><h2><?php echo $article['headline'];?></h2>
            </div>
            <div class="c_f">
                <div class="rating1"><span>Rating<br></span><?php echo $rating['total_value'];?> / 5</div>
            </div>
            <div class="company">
                <span><?php echo $article['name_company'];?></span>
            </div>
        </div>
    </a>
</div>