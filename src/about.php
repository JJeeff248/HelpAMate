<?php
	session_start();
	include("includes/public_connection.php");
	
	$title = "About";

	include("includes/page_template.php");
	include("includes/login.php");

	$_SESSION['page'] = 'about.php';

?>

<main>
	
	<div class="content" style="background-image: url('images/about.jpg'); background-size: cover; height:350px;" title="Photo by Adonyi Gábor from Pexels" alt="Photo of yellow flowers by Adonyi Gábor from Pexels">
	</div>
	
	<div class="content">

		<h2>About</h2>
		
		<p>Here at Help a Mate we are dedicated to providing a platform for people to spread love and bring joy to other people's lifes.</p>
		<p>Fundraisers can create an account to fundraise for anything from personal adventures to starting a charity event.</p>

	</div>
			
</main>

		
	</body>
</html>