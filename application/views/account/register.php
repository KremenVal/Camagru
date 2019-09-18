<?php
	require_once 'application/action/inputValue.php';
?>

<a href="/" style="text-align: center; text-decoration: none;"><h1 style="color: gold">Camagru</h1></a>
<div class="mainContainer"">
	<form action="/action/actionCreate" class="containerReg" method="post">
		<h1 style="color: dodgerblue">Sign Up</h1>
		<p style="color: dodgerblue">Please fill in this form to create an account.</p>
		<hr>
		<label for="login"><b style="color: dodgerblue">Login</b></label>
		<br>
		<input class="inputTextReg" type="text" title="keks" placeholder="Enter Login" name="login" value="<?php inputValue($_SESSION['loginValue']); ?>" required>
		<br>
		<label for="email"><b style="color: dodgerblue">Email</b></label>
		<br>
		<input class="inputTextReg" type="text" placeholder="Enter Email" value="<?php inputValue($_SESSION['emailValue']); ?>" name="email" required>
		<br>
		<label for="password"><b style="color: dodgerblue">Password</b></label>
		<br>
		<input class="inputPassReg" type="password" placeholder="Enter Password" name="password" required>
		<br>
		<label for="confirmPassword"><b style="color: dodgerblue">Repeat Password</b></label>
		<br>
		<input class="inputPassReg" type="password" placeholder="Repeat Password" name="confirmPassword" required>
		<br>
		<button type="submit" class="signupbtn" style="background-color: dodgerblue;" name="SignUp">Sign Up</button>
	</form>
</div>