<?php
session_start();

include "includes/public_connection.php";

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	header("Location: " . $_SESSION['page']);
}

$_SESSION['page'] = "user_info.php?action=" . $action;

if ($action == 'Create' && isset($_SESSION['activeUser'])) {
	$title = "Sign Up!";
} else if ($action == 'Edit' && isset($_SESSION['activeUser'])) {
	$title = "Update";
} else if ($action == 'Create') {
	$title = "Sign up!";
} else {
	header("Location: index.php");
}

include "includes/page_template.php";
if ($title == "Update") {
	include "includes/delete.php";
}
$user = $_SESSION['activeUser'];
?>

<main>

	<div class="content">
		<form method='post' action='process_fundraiser.php'>
			<div class='form' id="create_fundraiser">
				
				<?php echo "<h2>" . $title . "</h2>";
					if (isset($_SESSION['error'])) {
						echo "<p id='" . $_SESSION['error'] . "</p>";
						unset($_SESSION['error']);
					}
				?>



				<label for='FName'>First Name</label>
				<input type="text" id="FName" name="FName" placeholder="First Name" required <?php if (isset($user['FName'])) {echo "value='" . $user['FName'] . "'";}?>>
				<label for='LName'>Last Name</label>
				<input type="text" id="LName" name="LName" placeholder="Last Name" required <?php if (isset($user['LName'])) {echo "value='" . $user['LName'] . "'";}?>>
				<label for='dob'>Date of Birth</label>
				<input type='date' id="dob" name='dob' required <?php if (isset($user['DoB'])) {echo "value='" . $user['DoB'] . "'";}?>>
				<label for='email'>Email</label>
				<input type="email" id="email" name="Email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required title="Please enter a valid email " <?php if (isset($user['Email'])) {echo "value='" . $user['Email'] . "'";}?>>
				
				<?php
					if ($title == "Sign up!") {
						echo "<label for='Password'>Password</label>";
						echo "<input type='password' id='Password' name='Password' placeholder='Password' required>";
						echo "<label for='ConfirmPassword'>Confirm Password</label>";
						echo "<input type='password' id='ConfirmPassword' name='ConfirmPassword' placeholder='Confirm Password' required>";
					}
				?>
				
				<label for='Charity'>Charity to Support</label>
				<input type="text" id="Charity" name="Charity" placeholder="Charity" required <?php if (isset($user['Charity'])) {echo "value='" . $user['Charity'] . "'";}?>>
				<label for='Blurb'>Blurb</label>
				<textarea name="Blurb" id="Blurb" placeholder="Blurb" required><?php if (isset($user['Blurb'])) {echo $user['Blurb'];}?></textarea>
				<label for='Goal'>Goal</label>
				<!--<input type='number' id="Goal" name='Goal' placeholder='$100' max="50000" min="100" required <?php if (isset($user['Goal'])) {echo "value='" . $user['Goal'] . "'";}?>>-->
				<div class="flex">
					<span class="currency">$</span>
					<input type='number' id="Goal" name='Goal' placeholder='$100' max="50000" min="100" required <?php if (isset($user['Goal'])) {echo "value='" . $user['Goal'] . "'";}?>>
				</div>
				<input type="submit" name="submit" value="<?php echo $title; ?>" class="submit">


			</div>
		</form>
	</div>

<?php
if ($title == "Update") {?>
	<div class="content">
		<div class="form">
			<h3>Delete</h3>
			<button class='delete' onclick='toggleHide()'>Delete</button>
		</div>
	</div>
<?php }?>
</main>


	</body>
</html>