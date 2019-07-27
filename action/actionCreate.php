<?php
	session_start();
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	require_once '../config/database.php';
	require_once 'sendEmailVerification.php';

	$_SESSION['loginValue'] = $_POST['login'];
	$_SESSION['emailVAlue'] = $_POST['email'];
	$_SESSION['passwordValue'] = $_POST['password'];

	if (!isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirmPassword']))
	{
		$_SESSION['empty'] = 'You need to enter all field.';
		header('Location: ../pages/createAccount.php');
		return ;
	}

	if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 30)
	{
		$_SESSION['loginLen'] = true;
		header('Location: ../pages/createAccount.php');
		return ;
	}
	else if (preg_match('/[^A-Za-z0-9]/', $_POST['login']))
	{
		$_SESSION['loginSym'] = $_POST['login'];
		header('Location: ../pages/createAccount.php');
		return ;
	}

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['email'] = $_POST['email'];
		header('Location: ../pages/createAccount.php');
		return ;
	}

	if ($_POST['password'] != $_POST['confirmPassword'])
	{
		$_SESSION['password'] = 'Your passwords don\'t match.';
		header('Location: ../pages/createAccount.php');
		return ;
	}

	$location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionCreate.php", "", $_SERVER['REQUEST_URI']);
	$token = uniqid(rand(), true);
	$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sqlInsertInto = 'INSERT INTO users (login, email, password, token)
			value (:login, :email, :password, :token)';
	$result = $pdo->prepare($sqlInsertInto);
	$result->execute([':login' => $_POST['loggin'],
		':email' => $_POST['email'],
		':password' => hash('whirlpool', $_POST['password']),
		':token' => $token
	]);

	$_SESSION['loginValue'] = NULL;
	$_SESSION['emailVAlue'] = NULL;
	$_SESSION['passwordValue'] = NULL;

	sendEmailVerification($_POST['email'], $_POST['login'], $token, $location);
	header('Location: ../pages/createAccount.php');
?>