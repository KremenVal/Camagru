<?php
	session_start();
	phpinfo();
?>
<!DOCTYPE html>
<HTML>
<header>
	<link rel="stylesheet" type="text/css" href="../style/homePage.css">
	<meta charset="UTF-8">
	<title>CAMAGRU</title>
</header>
<body>
	<div class="mainHome">
		<?php
			if ($_GET['token'])
			{
				echo "<span>Hello MotherFucker!!</span><br>";
			}
		?>
		<label>Loggin or email</label>
		<input type="text" name="logginOrEmail" id="logginOrEmail" placeholder="Enter your logging or email">
		<br>
		<label>Password</label>
		<input type="password" name="password" id="password" placeholder="password">
		<br>
		<input type="submit" name="submit" value="Log In">
		<a href="createAccount.php">Create an account</a>
		<a href="recoverPassword.php">Forgot your password?</a>
	</div>
</body>
</HTML>