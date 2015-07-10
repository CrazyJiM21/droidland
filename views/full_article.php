<div class="back_full b3radius">
    <div id="c_full_block_f">
        <div class="img_full b3radius">
            <img width="100%" src="<?php echo $article['image']; ?>">
        </div>
        <div class="c_name_header_full"><h2><?php echo $article['headline']; ?></h2>
        </div>
        <div class="date"><?php echo $article['art_date']; ?>
        </div>
        <div class="f_c_name">
            <a href="<?php echo $article['category']; ?>/<?php echo $article['sub_category']; ?>"><?php echo $article['sub_category']; ?></a>
        </div>

        <div class="company1">
            <?php echo $article['name_company']; ?>
        </div>
    </div>
    <div class="c_f1">
        <?php require('rating/form.php');
        echo rating_bar($article['id_art'], 5); ?>
    </div>
    <div class="thumbs">
        <div class="thumbs_pics">

            <?php
            if (!empty($article['pics'])) {
                $pics = explode("!", $article['pics']);
                for ($i = 0; $i < count($pics); $i++)
                    printf('<a class="two" rel="group"  href="%sS.jpg"><img src="%s.jpg" /></a>', $pics[$i], $pics[$i]);
            }?>
        </div>
    </div>
    <div class="c_text"><p><?php echo $article['content']; ?></p>
    </div>
    <div class="more_info">
        <div class="size">
            Size</br>
            <?php echo $article['size']; ?> Mb
        </div>
        <div class="a_version">
            Android version</br>
            <?php echo $article['version']; ?>
        </div>
        <div class="downloads">
            Downloads</br>
            <?php echo $article['downloads']; ?>
        </div>
    </div>
    <div class="hole">
        <div></div>
    </div>
    <div class="buttons">
        <div align="center">
            <div class="d_free"><h2>Download free .apk:</h2></div>
            <div class="d_button"><a href="<?php echo $article['link']; ?>"><?php echo $article['headline']; ?></a>
            </div>
        </div>
        <?php
        if (!empty($_SESSION['id']) and $_SESSION['id'] == 1) {
            echo '
			<div class=" edit_button">
			    <a href="admin/edit_art.php?art_id=' . $article['id_art'] . '"><h4>Edit</h4></a>
			</div>
			</div>
			';
        }
        ?>
        <div class="similar">
            <div class="hole1">
                <div></div>
            </div>
            <span>Related <?php echo $article['category']; ?>:</span>

            <?php showRelatedArticles($article['sub_category'], $article['id_art']); ?>

        </div>
    </div>
</div>
