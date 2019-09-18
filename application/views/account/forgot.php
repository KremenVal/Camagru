<?php
	require_once 'application/action/inputValue.php';
?>

<a href="/" style="text-align: center; text-decoration: none;"><h1 style="color: gold">Camagru</h1></a>
<div class="mainContainer"">
	<form action="/action/actionRecoverPassword" class="containerReg" method="post">
		<h1>Forgot password?</h1>
		<label for="email"><b>Email</b></label>
		<br>
		<input class="inputTextReg" type="email" placeholder="Enter Email" value="<?php inputValue($_SESSION['emailValue']); ?>" name="email" required>
		<br>
		<button type="submit" class="signupbtn" style="background-color: crimson;">Send mail</button>
	</form>
</div>