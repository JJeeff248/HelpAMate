<?php
	session_start();
	include("includes/public_connection.php");

	if (isset($_GET['frid'])) {
		$frId = trim(mysqli_real_escape_string($dbc, $_GET['frid']));
		$_SESSION['frId'] = $frId;
	} else {
		header("Location: index.php");
	}
	
	//add query for fundraisers
	$fundraiser_query = "SELECT * FROM Fundraiser WHERE FundraiserId = ".$frId;
	
	$fundraiser_result = mysqli_query($dbc, $fundraiser_query);
	$fundraiser_record = mysqli_fetch_assoc($fundraiser_result);
	$title = $fundraiser_record['FName']." ".$fundraiser_record['LName']." | ".$fundraiser_record['Charity'];

	if (empty($fundraiser_record)) {
		header("Location: index.php");
	}

	include("includes/page_template.php");
	include("includes/login.php");
	include("includes/pledge.php");
	$_SESSION['page'] = 'fundraiser.php?frid='.$frId;


	$sum_query = "SELECT SUM(Pledge) FROM Donations WHERE FundraiserId = ".$frId;
	$sum_result = mysqli_query($dbc, $sum_query);
	$sum_record = mysqli_fetch_assoc($sum_result);
	$ammt_raised = $sum_record['SUM(Pledge)'];

	if($ammt_raised == '') {
		$ammt_raised = 0;
	}
	$percentage = ($ammt_raised / $fundraiser_record['Goal']) * 100;

	if ($percentage >= 100) {
		$width_percentage =100;
	} else {
		$width_percentage = $percentage;
	}
?>

<main>
	
	<div class="content fundraiser">
		<?php
			if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == $frId || isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'admin') {
				echo "<span id='edit'><a href='user_info.php?action=Edit'>Edit</a></span>";
				$fundraiser = array("Frid"=>$frId, "FName"=>$fundraiser_record['FName'], "LName"=>$fundraiser_record['LName'], "DoB"=>$fundraiser_record['DoB'], 
									"Email"=>$fundraiser_record['Email'], "Charity"=>$fundraiser_record['Charity'], "Blurb"=>$fundraiser_record['Blurb'], "Goal"=>$fundraiser_record['Goal']);
				$_SESSION['activeUser'] = $fundraiser;
			}
			echo "<h1>".$fundraiser_record['FName']." ".$fundraiser_record['LName']."</h1>";
			echo "<div class='charity'>".$fundraiser_record["Charity"]."</div>";
			echo "<div class='blurb'>".$fundraiser_record["Blurb"]."</div>";
			echo "<div><br>Raised - $".$ammt_raised." of $".$fundraiser_record['Goal']."</div>";
			echo "<div class='goal'> <div class='progress_wrapper'> <p>".number_format($percentage)."%</p> <div class='progress' style='width:".$width_percentage."%'> </div> </div> </div>";
			echo "<div class='donate'><button onclick='toggleHide()' class='pledge submit'>Pledge Now!</button></div>";
		?>
	</div>
	
	<div id='pledges'>
		<?php
			$pledge_query = "SELECT * FROM Donations WHERE FundraiserId = ".$frId;
			$pledge_result = mysqli_query($dbc, $pledge_query);
			while($pledge_record = mysqli_fetch_assoc($pledge_result)) {
				echo "<div class='content pledges' style='margin-top: 10px;'>";
				echo "<h3>".$pledge_record["DisplayName"]."</h3>";
				echo "<p>Pledged $".$pledge_record["Pledge"];
				echo "</div>";
			}
		?>
	</div>
			
</main>

		<footer>
			
		</footer>
	</body>
</html>
