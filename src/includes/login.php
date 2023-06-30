<div class="blurbg"></div>
<div class="display-box loginpopup">
	<form method="post" action="process_login.php" >
		<div class="form">
			<span class="close login" onclick='toggleHide()'>×</span>
			<h2>Login</h2>
			<?php 
				if(isset($_SESSION["loginError"])) {
					echo "<p id='".$_SESSION["loginError"]."</p>";
				}
			?>
			<input type="text" name="username" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<!--<a href="user_info.php?action=Create">Create Fundraiser</a>-->
			<input name="submit" type="submit" value="Create Fundraiser" class="submit">
			<input name="submit" type="submit" value="Login" class="submit">
		</div>
	</form>
</div>