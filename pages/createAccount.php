<?php
	session_start();
?>
<!DOCTYPE html>
<HTML>
<header>
	<link rel="stylesheet" type="text/css" href="../style/homePage.css">
	<meta charset="UTF-8">
	<title>Create an account</title>
</header>
<body>
	<div class="createAccount">
        <?php
            if ($_SESSION['success'])
            {
                echo $_SESSION['success'];
                $_SESSION['success'] = null;
            }
        ?>
		<form method="post" action="../action/actionCreate.php">
			<?php
				if ($_SESSION['empty'])
				{
					echo '<span>' . $_SESSION['empty'] . '</span><br>';
					$_SESSION['empty'] = null;
				}
			?>
			<label>Loggin</label>
			<input type="text" name="loggin" id="loggin" placeholder="Enter your logging" required value=
			<?php
				if ($_SESSION['loggingLen'])
				{
					echo $_SESSION['loggingLen'];
				}
				else if ($_SESSION['loggingSym'])
				{
					echo $_SESSION['loggingSym'];
				}
			?>>
			<?php
				if ($_SESSION['loggingLen'])
				{
					echo "<br><span>Loggin should be beetween 3 and 30 characters.</span>";
					$_SESSION['loggingLen'] = null;
				}
				else if ($_SESSION['loggingSym'])
				{
					echo "<br><span>HUI</span>";
					$_SESSION['loggingSym'] = null;
				}
			?>
			<br>
			<label>Email</label>
			<input type="text" name="email" id="email" placeholder="example@gmail.com" required value=
			<?php
				if ($_SESSION['email'])
				{
					echo $_SESSION['email'];
				}
			?>>
			<?php
				if ($_SESSION['email'])
				{
					echo "<br><span>You enter invalid email. Please, enter vaild email.</span>";
					$_SESSION['email'] = null;
				}
			?>
			<br>
			<label>Password</label>
			<input type="password" name="password" id="password" placeholder="password" required>
			<br>
			<?php
				if ($_SESSION['password'])
				{
					echo '<span>' . $_SESSION['password'] . '</span><br>';
					$_SESSION['password'] = null;
				}
			?>
			<label>Confirm password</label>
			<input type="password" name="confirmPassword" id="confirmPassword" placeholder="password" required>
			<br>
			<input type="submit" name="submit" value="Create">
		</form>
	</div>
</body>
</HTML>