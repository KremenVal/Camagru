<?php
	session_start();
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
        <form method="post" action="../action/actionHome.php">
            <label>Loggin or email</label>
            <input type="text" name="logginOrEmail" id="logginOrEmail" placeholder="Enter your logging or email">
            <br>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="password">
            <br>
            <input type="submit" name="submit" value="Log In">
            <a href="createAccount.php">Create an account</a>
            <a href="recoverPassword.php">Forgot your password?</a>
        </form>
	</div>
</body>
</HTML>