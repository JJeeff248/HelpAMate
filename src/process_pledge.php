<?php
	session_start();
	include('includes/admin_connection.php');	

	function donorCheck($dbc) {
		$dbcheck_query = "SELECT * FROM Donors WHERE Email = '".$_SESSION['DonorEmail']."'";
		$dbcheck_result = mysqli_query($dbc, $dbcheck_query);
		$dbcheck_record = mysqli_fetch_assoc($dbcheck_result);
		return $dbcheck_record;
	}

	function insertDonation($dbc) {
		// Insert donation in to db
		$add_pledge = $dbc->prepare("INSERT INTO Donations (DonorId, FundraiserId, Pledge, DisplayName) VALUES (?, ?, ?, ?)");
		$add_pledge->bind_param("iiis", $_SESSION['donorId'], $_SESSION['frId'], $_SESSION['Pledge'], $_SESSION['DisplayName']);
		$add_pledge->execute();
		$add_pledge->close();
		header("Location: ".$_SESSION['page']);
		exit;
	}

	// Set variables using data sent from pledge.php form
	if (isset($_POST['Email']) && isset($_POST['DisplayName']) && isset($_POST['radio'])) {
		$email = trim(mysqli_real_escape_string($dbc, $_POST['Email']));
		$displayName = trim(mysqli_real_escape_string($dbc, $_POST['DisplayName']));
		$pledge = trim(mysqli_real_escape_string($dbc, $_POST['radio']));
		
		// Set variables to sessions
		$_SESSION['DonorEmail'] = $email;
		$_SESSION['DisplayName'] = $displayName;
		$_SESSION['Pledge'] = $pledge;
			
		// Get user inputed number when other was selected
		if($pledge == 'on') {
			$pledge = trim(mysqli_real_escape_string($dbc, $_POST['other']));
			$_SESSION['Pledge'] = $pledge;
		}
	}

	if(isset($email)) {
		// Check if email is in the data base
		$dbcheck_record = donorCheck($dbc);
		
		if (isset($dbcheck_record['Email']) && $dbcheck_record['Email'] == $_SESSION['DonorEmail']) {
			$_SESSION['donorId'] = $dbcheck_record['DonorId'];
			header("Location: email_check.php");
			exit;
		}
		
		if(isset($dbcheck_record['DonorId'])) {
			$_SESSION['donorId'] = $dbcheck_record['DonorId'];
		} else {
			// Add new donor
			$add_donor = $dbc->prepare("INSERT INTO Donors (Email) VALUES (?)");
			$add_donor->bind_param("s", $_SESSION['DonorEmail']);
			$add_donor->execute();
			$add_donor->close();
			// Get their Id
			$dbcheck_record = donorCheck($dbc);
			$_SESSION['donorId'] = $dbcheck_record['DonorId'];
			insertDonation($dbc);
		}
		
	}

	if(isset($_POST['submit'])){
		if($_POST['submit'] == 'Yes') {			
			insertDonation($dbc);
		} else if ($_POST['submit'] == 'No') {
			// Ask for new email
			$_SESSION['emailerror'] = "error'>Please enter a new email";
			header('Location: '.$_SESSION['page']);
			exit;
		}
	}
?>

