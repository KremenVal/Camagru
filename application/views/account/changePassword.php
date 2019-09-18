<?php
	require_once 'application/action/inputValue.php';
	require 'application/config/database.php';

	if(!isset($_GET['token']))
	{
		header('Location: /');
	}

	$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
	$result = $pdo->prepare('SELECT * FROM users  WHERE token=:token');
	$result->execute(array('token' => $_GET['token']));
	$valueToken = $result->fetch();

	if (!$valueToken)
	{
		header('Location: /');
	}
?>

<a href="/" style="text-align: center; text-decoration: none;"><h1 style="color: gold">Camagru</h1></a>
<div class="mainContainer"">
	<form action="/action/changePassword" class="containerReg" method="post">
		<input type="hidden" name="token" id="token" value=<?php echo $_GET['token']; ?>>
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