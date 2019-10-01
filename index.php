<?php
	session_start();

	spl_autoload_register(function ($class) {
		$path = str_replace('\\', '/', $class . '.php');

		if (file_exists($path))
		{
			require $path;
		}
	});

	if (!isset($_SESSION['logIn']) || !$_SESSION['logIn'])
	{

		$_SESSION['logIn'] = '';
		$_SESSION['user'] = '';
		$_SESSION['idUser'] = '';
		$_SESSION['email'] = '';
		$_SESSION['password'] = '';
		$_SESSION['emailValue'] = '';
		$_SESSION['loginValue'] = '';
		require 'application/config/setup.php';
	}

	$router = new application\core\Router();
	$router->run();