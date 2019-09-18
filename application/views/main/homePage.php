<?php
	require_once 'application/action/inputValue.php';

	if (isset($_SESSION['logIn']) && $_SESSION['logIn'] && isset($_SESSION['idUser']))
	{
		header('Location: /action/actionHome');
	}

	$_SESSION['loginOrEmail'] = $_SESSION['loginOrEmail'] ? $_SESSION['loginOrEmail'] : null;
?>
<form action="/action/actionHome" class="mainForm" method="post">
	<h1 style="text-align: center; color: gold">Camagru</h1>
	<div class="imgMainContainer">
		<img src="application/images/img_avatar2.png" alt="Avatar" class="avatar">
	</div>
	<div class="mainContainer">
		<label for="loginOrEmail"><b>Username</b></label>
		<input class="inputTextMain" type="text" placeholder="Enter Username" name="loginOrEmail" value="<?php inputValue($_SESSION['loginOrEmail']); ?>">
		<label for="password"><b>Password</b></label>
		<input class="inputPassMain" type="password" placeholder="Enter Password" name="password">
		<button type="submit">Login</button>
		<a href="/account/register"><button type="button" class="signUpBtn" style="width:auto;">Sing up</button></a>
		<a href="/account/forgot"><button type="button" class="forgotBtn">Forgot password?</button></a>
	</div>
</form>
<?php require 'application/function/DeleteSession.php'; ?>
