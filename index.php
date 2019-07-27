<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	session_start();

	if (!isset($_SESSION['logged']))
	{
		require_once 'config/setup.php';
		header('Location: pages/homePage.php');
	}
	else
	{
		echo "string";
	}
?>