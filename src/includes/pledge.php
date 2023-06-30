
<script>
	$(document).ready(function(){
		if($('#pledge').css('display') == 'none') {
			$('input[value=5]').prop('checked', true);
		}
			
		$("input[type=radio]").change(function(){
			$("#othertext").hide();
			$('#othertext').val('');
		});
		$("input[id=other]").change(function(){
			$("#othertext").show();
		});
	});
</script>

<div class="display-box pledge">
	<form method="post" action="process_pledge.php" >
		<div class="form">
			<span class="close pledge" onclick='toggleHide()'>×</span>
			<h2>Pledge</h2>
			<?php 
				if(isset($_SESSION["emailerror"])) {
					echo "<span id='".$_SESSION["emailerror"]."</span>";
				}
			?>
			<input type="email" required name="Email"   title="Email format: example@example.com" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
			<input type="text" required name="DisplayName" title="2 to 10 characters" placeholder="Display Name" pattern=".{2,15}">
			
			<label class="container">
				<input type="radio" checked="checked" name="radio" value="5">
				<span class="checkmark">$5</span>
			</label>
			<label class="container">
				<input type="radio" name="radio" value="20">
				<span class="checkmark">$20</span>
			</label>
			<label class="container">
				<input type="radio" name="radio" value="50">
				<span class="checkmark">$50</span>
			</label>
			<label class="container">
				<input type="radio" id='other' name="radio">
				<span class="checkmark">Other</span>
			</label>
			
			<div class="flex" id="othertext" style="display:none;"> <!-- https://www.youtube.com/watch?v=Uu8_7XhRzV0 -->
				<span class="currency">$</span>
				<input type='number' id="other" name='other' placeholder='100' max="100" min="5" <?php if (isset($user['other'])) {echo "value='" . $user['other'] . "'";}?>>
			</div>
			<input type="submit" value="Pledge" class="submit">
			
		</div>
	</form>
</div>
