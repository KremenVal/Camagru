<?php
	session_start();
	require 'application/lib/Dev.php';

	spl_autoload_register(function ($class) {
		$path = str_replace('\\', '/', $class . '.php');

		if (file_exists($path))
		{
			require $path;
		}
	});

	if (!isset($_SESSION['logged']))
	{
		require 'application/config/setup.php';
	}
	else
	{
		echo "string";
	}

	$router = new application\core\Router();
	$router->run();