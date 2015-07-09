<?php
	if (preg_match("/[0-9]/", $_GET['art_id'])) {
	 	$query = sprintf("SELECT * FROM articles WHERE id_art = '%s'",$_GET['art_id']);
	 	$result1 = mysql_query($query);
    	$articles = mysql_fetch_array($result1);
		if (!empty($articles['id_art'])) {
			printf('<div class="back_full b3radius">
			<div id="c_full_block_f">
			<div class="img_full b3radius">
			<img width="100%%" src="%s">
			</div>
			<div class="c_name_header_full"><h2>%s</h2>
			</div>
			<div class="date">%s
			</div>
			<div class="f_c_name">
			<a href="%s/%s">%s</a>
			</div>
			
			<div class="company1">
			%s
			</div>
			</div>
			<div class="c_f1">
			',$articles['image'],$articles['headline'], $articles['art_date'], $articles['category'], $articles['sub_category'], $articles['sub_category'],$articles['name_company']
			);
			require('rating/form.php');
			$userrating=$_GET['art_id']; // имя пользователя за кооторого голосуем, или ID
			echo rating_bar($userrating,5);			
			
			print('</div>	
			<div class="thumbs">
			<div class="thumbs_pics">
			');
			if (!empty($articles['pics'])) 
			{
				$pics = explode("!", $articles['pics']);
				for ($i = 0; $i < count($pics); $i++)
	        	printf('<a class="two" rel="group"  href="%sS.jpg"><img src="%s.jpg" /></a>', $pics[$i], $pics[$i]);
			}
			printf('</div>
			</div>
			<div class="c_text"><p>%s</p>
			</div>
			<div class="more_info">
			<div class="size">
			Size</br>
			%s Mb
			</div> 
			<div class="a_version">
			Android version</br>
			%s
			</div>
			<div class="downloads">    
			Downloads</br>
			%s
			</div>
			</div>
			<div class="hole"><div></div></div>
			<div class="buttons">
			<div align="center">
			<div class="d_free"><h2>Download free .apk:</h2></div>
			<div class="d_button"><a href="%s">%s</a></div>
			</div>
			', $articles['content'], $articles['size'], $articles['version'], $articles['downloads'], $articles['link'], $articles['headline']
			);
			if (!is_null($_SESSION['id']) and $_SESSION['id'] == 1)
        	printf('
			<div class=" edit_button">
			<a href="admin/edit_art.php?art_id=%s"><h4>Edit</h4></a>
			</div>
			</div>
			', $_GET['art_id']);
			printf('
			<div class="similar"><div class="hole1"><div></div></div><span>Related %s:</span>', $articles['category']);
			
        	$sql = sprintf("SELECT * FROM articles WHERE sub_category = '%s' and id_art <> '%s' LIMIT 6", $articles['sub_category'], $articles['id_art']);
        	$result = mysql_query($sql, $db) or die(mysql_error());
        	$similar = mysql_fetch_array($result);
        	do {
	            $sim_title = $similar['headline'];
				$sim_cat = $similar['category'];
	            $sim_image = $similar['image'];
	            $sim_id = $similar['id_art'];
	            if (isset($sim_title))
				printf("<a href='%s/art%s'><div class='similar_art'>
				<div class='sim_img'>
				<img src='%s' width='100%%'> 
				</div>
				<div class='sim_title'>
				%s
				</div>
				</div></a>", $sim_cat, $sim_id, $sim_image, $sim_title);
			}
        	while($similar = mysql_fetch_array($result));
			/*
				printf('                            
				</div>
				
				<div class="comments">
				<div class="comment_form">
				<form action="admin/add_com.php?art_id=%s" method="POST">
				<p class="similar">
				<span>Leave your comment</span>
				</p>
				<p>	
				Your name:</br>
				<input name="name" type="text" required>
				</p></br>
				<p>Your comment:</br>
				<textarea name="text" cols="50" rows="7" required></textarea>
				</p></br>
				<input type="submit" class="comm_submit" value="Submit">
				</form>
				</div>
				<div class="all_comments">
				', $_GET['art_id']);
				
				$sql = sprintf("SELECT * FROM comments WHERE id_art = '%s' ORDER BY id DESC", $_GET['art_id']);
				$result = mysql_query($sql, $db) or die(mysql_error());
				$comments = mysql_fetch_array($result);
				do {
	            $com_name = $comments['name'];
	            $com_text = $comments['text'];
	            $com_date = $comments['date'];
	            if (isset($com_name))
				printf("
				<div class='comment'>
				<div class='comm_name' width='50%%'>%s</div>
				<div class='comm_date' width='50%%'>%s</div>
				
				<div class='comm_text'>%s</div>
				
				</div>", $com_name, $com_date, $com_text);
				}
				while($comments = mysql_fetch_array($result));		
			*/
			echo "</div></div></div>";
		}
		else echo "<h1>404 PAGE NOT FOUND!</h1>";
	}
	else echo "<h1>404 PAGE NOT FOUND!</h1>";
?>