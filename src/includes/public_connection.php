<?php
	$dbc = mysqli_connect("localhost", "sach_public", 'password', "sach_Fundraiser");
	if ($dbc == NULL) { 
		echo "<h1>Sorry, you could not connect to the database</h1>";
		exit(); 
	};
?>
