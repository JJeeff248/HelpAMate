<script>
	$(document).ready(function(){

		$("input[type=radio]").change(function(){
			$("#confirm").hide();
			$('#confirm').val('');
		});
		$("input[id=yes]").change(function(){
			$("#confirm").show();
		});
	});
</script>

<div class="blurbg"></div>
<div class="display-box deletepopup">
	<form method='post' action='process_fundraiser.php'>
		<div class="form">
			<span class="close delete" onclick='toggleHide()'>×</span>
			<h2>Delete</h2>
			<p>Deleting your fundraiser cannot be undone.</p>
			<p>Are you sure you want to continue?</p>
			<label class="container">
				<input type="radio" name="radio" id='yes' calss='delete_confirm'>
				<span class="checkmark delete_confirm">Yes</span>
			</label>
			<label class="container">
				<input type="radio" calss='delete_confirm' name="radio" value="no">
				<span class="checkmark delete_confirm" onclick='toggleHide()'>No</span>
			</label>

			<input id="confirm" name="Password" style='display:none' type="password" placeholder="Password" required>
			<input type="hidden" value="<?php echo $_SESSION['activeUser']['Frid'] ?>" name="frid" />
			<input type="submit" name="submit" value="Delete" class="submit delete">
		</div>
	</form>
</div>