<!DOCTYPE html>
<html>
	<body>
		
		<div class="header">
			<div class="logo">
				<a href="/"><img width="100%" src="images/logo1.png"></a>
			</div>
			
			<div class="login">
				<ul>
					<?php
						if(!empty($_SESSION)) {
                            if (is_null($_SESSION['id'])) {
                                echo '
							<li><a id="go" rel="leanModal" name="signup" href="#loginform">Логин</a></li>
							<li><a id="go" rel="leanModal" name="signup" href="#signup"></a></li>
                                ';
                            } else {
                                printf("<li><span>%s</span></li>
							    <li><a href='logoff.php'>Exit</a></li>"
                                    , $_SESSION['login']);
                            }
                        }
					?>
				</ul>
			</div>
			<!--<div class="soc">
				<ul>
				<li>
				<a href="https://twitter.com/SBootstrap"><i class="fa fa-twitter fa-fw"></i></a>
				</li>
				<li>
				<a href="https://vk.com/brest_american_football"><i class="fa fa-vk fa-fw"></i></a>
				</li>
				<li>
				<a href="https://plus.google.com/+Startbootstrap/posts"><i class="fa fa-facebook fa-fw"></i> </a>
				</li>
				</ul>
				</div>
				
				
			-->
			
			<div id="h_nav">
				<ul>
					<?php
						include("admin/bd.php");
						$result = mysql_query("SELECT * FROM categories",$db);
						$categories = mysql_fetch_array($result);
						if (!empty($categories['id_cat'])) {
							do {
								$name = $categories['name'];
								printf("
								<li><a href='%s'>%s</a></li>
								",$categories['translit'], $categories['name']);
							}
							while($categories = mysql_fetch_array($result));
						}
					?>
				</ul>
				
			</div>
			
			<form name="search" method="post" action="search.php">
				<input type="submit" name="bsearch" value="GO" class="search_img">
				<input type="text" name="words" placeholder="Find some...">
			</form>
			
		</div>
		
		
		<div class="user_panel">
			
			<?php if(isset($_SESSION['id'])) {
                echo "<strong>Hello, {$_SESSION['login']}!</strong>";

                if ($_SESSION['id'] > 1) {
                    echo '
					<div class="admin_button"><a href="new_art.php">My apps</a></div>
					<div class="admin_button"><a href="new_cat.php">My comments</a></div>
					<div class="admin_button"><a href="user_profile.php">My profile</a></div>
					';

                }
                if ($_SESSION['id'] == 1) {
                    echo '
					<div class="admin_button"><a href="new_art.php">Мои приложения</a></div>
					<div class="admin_button"><a href="new_cat.php">Мои комментарии</a></div>
					<div class="admin_button"><a href="user_profile.php">Мой профиль</a></div>
					<div class="admin_button"><a href="admin/admin.php">Админ панель</a></div>
                    ';
                }
            }
			?>
		</div>
		<!-- Modal windows -->
		<div id="signup">
			<div id="signup-ct">
				<div id="signup-header">
					<h2>Создать новый аккаунт</h2>
				</div>
                
				<form action="save_user.php" method="post" enctype="multipart/form-data">
					<div class="txt-fld">
						<label for="">Логин:</label>
						<input id="" name="login" type="text" required/>
					</div>
					<div class="txt-fld">
						<label for="">Пароль:</label>
						<input id="" name="password" type="password" required/>
					</div>
					<div class="txt-fld">
						<label for="">Аватар:</label>
						<input type="FILE" name="avatar">
					</div>
					<div class="txt-fld">
						<label for="">Email:</label>
						<input id="" name="email" type="email" required/>
					</div>
					<div class="txt-fld">
						<label for="">Location:</label>
						<select class="input" size="1" name="location">
							<?php
								$result = mysql_query("SELECT * FROM countries",$db);
								$countries = mysql_fetch_array($result);
								do {
									$name = $countries['country_name'];
									$iso = $countries["cc_iso"];
									printf("
									<option value='%s'>%s</option>
									", $iso, $name);
								}
								while($countries = mysql_fetch_array($result));
							?>
						</select>
					</div>
					<div class="btn-fld">
						<button type="submit">Регистрация</button>
					</div>
				</form>
			</div>
		</div>
		
		<div id="loginform">
			<div id="signup-ct">
				<div id="signup-header">
					<h2>Войти</h2>
				</div>
                
				<form action="login.php" method="post">
					<div class="txt-fld">
						<label for="">Логин:</label>
						<input id="" name="login" type="text" required/>
					</div>
					<div class="txt-fld">
						<label for="">Пароль:</label>
						<input id="" name="password" type="password" required/>
					</div>
					<p>Приносим извинения!<br> в данный момент регистрация новых пользователей не производится.</p>
					<div class="btn-fld">
						<button type="submit">Войти</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>