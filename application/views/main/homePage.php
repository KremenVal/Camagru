<?php
	require_once 'application/function/InputValue.php';

	if (isset($_SESSION['logIn']) && isset($_SESSION['idUser']) && isset($_SESSION['user'])
		&& !empty($_SESSION['logIn']) && !empty($_SESSION['idUser']) && !empty($_SESSION['user']))
	{
		header('Location: /user/allPhotos');
	}
?>
<form action="/action/actionHome" class="mainForm" method="post">
	<div class="imgMainContainer">
		<img src="application/images/img_avatar2.png" alt="Avatar" class="avatar">
	</div>
	<div class="mainContainer">
		<label for="loginOrEmail"><b>Username</b></label>
		<input class="inputTextMain" type="text" placeholder="Enter Username" name="loginOrEmail" value="<?= InputValue($_SESSION['user'], $_SESSION['email']); ?>">
		<label for="password"><b>Password</b></label>
		<input class="inputPassMain" type="password" placeholder="Enter Password" name="password">
		<button type="submit">Login</button>
		<a href="/account/register"><button type="button" class="signUpBtn" style="width:auto;">Sing up</button></a>
		<a href="/account/forgot"><button type="button" class="forgotBtn">Forgot password?</button></a>
	</div>
</form>
