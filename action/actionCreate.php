<?php
	session_start();
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	require_once '../config/database.php';
	require_once 'sendEmailVerification.php';

	if (!isset($_POST['loggin']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirmPassword']))
	{
		$_SESSION['empty'] = 'You need to enter all field.';
		header('Location: ../pages/createAccount.php');
	}

	if (strlen($_POST['loggin']) < 3 || strlen($_POST['loggin']) > 30)
	{
		$_SESSION['loggingLen'] = $_POST['loggin'];
		header('Location: ../pages/createAccount.php');
	}
	else if (preg_match('/[^A-Za-z0-9.-]/', $_POST['loggin']))
	{
		$_SESSION['loggingSym'] = $_POST['loggin'];
		header('Location: ../pages/createAccount.php');
	}

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['email'] = $_POST['email'];
		header('Location: ../pages/createAccount.php');
	}

	if ($_POST['password'] != $_POST['confirmPassword'])
	{
		$_SESSION['password'] = 'Your passwords don\'t match.';
		header('Location: ../pages/createAccount.php');
	}

	require_once '../function/AddUser.php';

	sendEmailVerification($_POST['email'], $_POST['loggin'], $token, $location);
	$_SESSION['success'] = 'Account has been successfully created';
	$_SESSION['user'] = $_POST['loggin'];
    header('Location: ../pages/createAccount.php');
?>