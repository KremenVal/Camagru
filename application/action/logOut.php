<?php
	if (!empty($_SESSION) && isset($_SESSION['logIn']))
	{
		foreach ($_SESSION as $key => $value)
		{
			unset($_SESSION[$key]);
		}
	}
	header('Location: /');