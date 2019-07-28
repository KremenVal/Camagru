<?php
	session_start();
	require '../action/errorMessage.php';
	require '../action/inputValue.php';
?>
<!DOCTYPE html>
<HTML>
<header>
	<link rel="stylesheet" type="text/css" href="../style/createAccount.css">
	<meta charset="UTF-8">
	<title>Create an account</title>
</header>
<body>
	<div class="createAccount">
		<form method="post" action="../action/actionCreate.php">
			<?php errorEmpty(); ?>
			<div class="row">
				<input type="text" name="login" id="login" required value=<?php inputValue($_SESSION['loginValue']); ?>>
				<?php errorLogin(); ?>
			</div>
			<div class="row">
				<input type="text" name="email" id="email" required value=<?php inputValue($_SESSION['emailValue']); ?>>
				<?php errorEmail(); ?>
			</div>
			<div class="row">
				<input type="password" name="password" id="password" required>
				<label class="lableRight" for="pass">Password</label>
			</div>
			<div class="row">
				<input type="password" name="confirmPassword" id="confirmPassword" required>
				<?php errorConfirmPassword(); ?>
			</div>
			<input type="submit" name="submit" value="Create">
		</form>
	</div>
</body>
</HTML>