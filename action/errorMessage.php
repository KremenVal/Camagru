<?php
	session_start();

	function errorEmpty()
	{
		echo '<span>' . $_SESSION['empty'] . '</span><br>';
		$_SESSION['empty'] = null;
	}

	function errorLogin()
	{
		if ($_SESSION['loginLen'])
		{
			echo '<label class="lableError" for="login">Login should be beetween 3 and 20 characters.</label>';
			$_SESSION['loginLen'] = null;
		}
		else if ($_SESSION['loginSym'])
		{
			echo '<label class="lableError" for="login">Invalid characters entered in the Login.</label>';
			$_SESSION['loginSym'] = null;
		}
		else
		{
			echo '<label class="lableRight" for="login">Login</label>';
		}
	}

	function errorEmail()
	{
		if ($_SESSION['email'])
		{
			echo '<label class="lableError" for="email">You entered invalid email.</label>';
			$_SESSION['email'] = null;
		}
		else
		{
			echo '<label class="lableRight" for="email">Email</label>';
		}
	}

	function errorConfirmPassword()
	{
		if ($_SESSION['password'])
		{
			echo '<label class="lableError" for="confirmPassword">' . $_SESSION['password'] . '</label>';
			$_SESSION['password'] = null;
		}
		else
		{
			echo '<label class="lableRight" for="confirmPassword">Confirm Password</label>';
		}
	}
?>