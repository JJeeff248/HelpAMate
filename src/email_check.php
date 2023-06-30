<?php

	session_start();

	$title = "Email Check";
	include("includes/page_template.php");

?>

<main>
	
	<div class="content">
		<form method='post' action="process_pledge.php">
			<div class="form" id="emailcheck">
				<span>You have used this email address before: <br></span>
				<?php echo "<span id='email'>".$_SESSION['DonorEmail']."<br></span>"; ?>
				<span>Would you like to use it again?<br></span>
				<input type="submit" name='submit' class="submit" value="Yes">
				<input type="submit" name='submit' class="submit" value="No">
			</div>
		</form>
	</div>
	
</main>

		<?php #include("includes/footer.php"); ?>
	</body>
</html>