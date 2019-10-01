<?php
	require 'application/config/database.php';
	require_once 'application/function/DbOperations.php';

	if (empty($_GET) && !isset($_GET['token']))
	{
		header('Location: /');
	}

	$Token = CheckToken($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_GET['token']);
	if (!isset($Token['token']))
	{
		header('Location: /');
	}
?>

<a href="/" style="text-align: center; text-decoration: none;"><h1 style="color: gold">Camagru</h1></a>
<div class="mainContainer"">
	<form action="/action/changePassword" class="containerReg" method="post">
		<input type="hidden" name="token" id="token" value=<?= $_GET['token']; ?>>
		<h1 style="color: #4CAF50">Change password</h1>
		<label for="password"><b style="color: #4CAF50">Password</b></label>
		<br>
		<input class="inputPassReg" type="password" placeholder="Enter Password" name="password" required>
		<br>
		<label for="confirmPassword"><b style="color: #4CAF50">Repeat Password</b></label>
		<br>
		<input class="inputPassReg" type="password" placeholder="Repeat Password" name="confirmPassword" required>
		<br>
		<button type="submit" class="signupbtn">Change</button>
	</form>
</div>