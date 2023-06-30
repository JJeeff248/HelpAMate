<?php
	session_start();
	include("includes/public_connection.php");
	if(isset($_SESSION["loginerror"])) {
		session_unset($_SESSION["loginerror"]);
	}
	
	$title = "Explore";
	include("includes/page_template.php");

	include("includes/login.php");

	//add query for fundraisers
	$fundraiser_query = "SELECT FundraiserId, FName, LName, Charity, Blurb, Goal 
	FROM Fundraiser";
	
	$fundraiser_result = mysqli_query($dbc, $fundraiser_query);

	$_SESSION['page'] = 'index.php';
?>

<main>
	
	<div id="fundraisers">
		<?php 
			while ($fundraiser_record = (mysqli_fetch_assoc($fundraiser_result))) {
				$pledge_query = "SELECT SUM(Pledge) FROM Donations WHERE FundraiserId = ".$fundraiser_record["FundraiserId"];
				$pledge_result = mysqli_query($dbc, $pledge_query);
				$pledge_record = mysqli_fetch_assoc($pledge_result);
				$ammt_raised = $pledge_record['SUM(Pledge)'];
				$percentage = ($ammt_raised / $fundraiser_record['Goal']) * 100;
				if ($percentage >= 100) {
					$width_percentage =100;
				} else {
					$width_percentage = $percentage;
				}
				echo "<article class='content fundraiser'>";
				echo "<h2>".$fundraiser_record["FName"]." ".$fundraiser_record["LName"]."</h2>";
				echo "<div class='charity'>".$fundraiser_record["Charity"]."</div>";
				echo "<div class='blurb'>".$fundraiser_record["Blurb"]."</div>";
				echo "<div class='goal'><div class='progress_wrapper'><p>".number_format($percentage)."%</p><div class='progress' style='width:".$width_percentage."%'></div></div></div>";
				echo "<div class='view'><a href='fundraiser.php?frid=".$fundraiser_record["FundraiserId"]."'>View</a></div>";
				echo "</article>";
			}
		?>
	</div>
			
</main>

		<?php #include("includes/footer.php"); ?>
	</body>
</html>
