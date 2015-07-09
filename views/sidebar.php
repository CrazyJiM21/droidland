<!DOCTYPE html>
<html>
	
	<body>
		
		<div class="sidebar">
			
			<?php
			    if (!empty($_GET['cat'])) {
                    include("admin/bd.php");
                    $query = sprintf("SELECT * FROM sub_category WHERE super_cat='%s'", $_GET['cat']);
                    $result = mysql_query($query, $db);
                    $subcat = mysql_fetch_array($result);
                    if (!empty($subcat['id_sub_cat'])) {
                        echo '<div class="c_list">';
                        echo '<ul>';
                        do {
                            $title = $subcat['title'];
                            $query2 = sprintf("SELECT COUNT(*) FROM articles WHERE sub_category='%s'", $subcat['title']);
                            $result2 = mysql_query($query2, $db);
                            $sub_count = mysql_fetch_array($result2);
                            printf("
						<li><a href='%s/%s'><h3>%s</h3><span class='sb_num'>%s<span></a></li>
						", $_GET['cat'], $subcat['title'], $subcat['title'], $sub_count[0]);
                        } while ($subcat = mysql_fetch_array($result));
                        echo '</ul>';
                        echo '</div>';
                    }
                }
			?>
			
			
			<div id="topnews">
				<div class="menu_name b3radius b_shadow"><p><i color="white" class="fa fa-star"></i>  Топ приложений</p></div>	
				<?php
					$result1 = mysql_query("SELECT * FROM ratings ORDER BY total_value DESC LIMIT 10",$db);
					$toprate = mysql_fetch_array($result1);
					if (!empty($toprate['id'])) {
						do {
							$query = sprintf("SELECT * FROM articles WHERE id_art = %s", $toprate['id']);
							$result2 = mysql_query($query);
							$topnews = mysql_fetch_array($result2);
							printf('				
							<div class="top_list_block b3radius"><a href="%s/art%s">
							<div id="t_img"><img width="100%%" src="%s"></div>
							<div id="t_name">
							<h5>%s</h5></a>
							
							
							
							<div class="sidebar_category">%s</div>
							
							
							
							
							</div>
							</div>
							', $topnews['category'], $topnews['id_art'], $topnews['image'], $topnews['headline'], $topnews['sub_category']);
						}
						while($toprate = mysql_fetch_array($result1));
					}
					
				?>
			</div>
			
			
		</div>
		
	</body>
</html>