<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title;?></title>

		<meta name="description" content="#">
		<link href="css/styles.css" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="scripts/togglehide.js"></script>
	</head>

	<body >
	
	<header>
		<nav>
			<h1 class="title">Help a Mate</h1>
			<ul>
				<li><a href="index.php">Explore</a></li>
				<li><a href="about.php">About</a></li>
				<?php
					if(isset($_SESSION['loggedIn'])) {
						echo "<li><button class='login' id='logout' onclick='window.location.href=\"process_login.php\"'>Logout</button></li>";
					} else {
						echo "<li><button class='login' id='login' onclick='toggleHide()'>Login / Create</button></li>";
					}
				?>
				
			</ul>
		</nav>
	</header>
	
