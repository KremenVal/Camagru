<?php
	session_start();
    $_SESSION['loginValue'] = $_POST['login'];
    $_SESSION['emailValue'] = $_POST['email'];

	require_once '../config/database.php';
    require_once 'sendEmailVerification.php';
    require_once '../function/CheckUser.php';

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
		$_SESSION['loginSym'] = true;
		header('Location: ../pages/createAccount.php');
		return ;
	}
	else if ($loginExist)
    {
        $_SESSION['loginExist'] = true;
        header('Location: ../pages/createAccount.php');
        return ;
    }

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['email'] = true;
		header('Location: ../pages/createAccount.php');
		return ;
	}
	else if ($valEmail['email'])
    {
        $_SESSION['emailExist'] = true;
        header('Location: ../pages/createAccount.php');
        return ;
    }

	if ($_POST['password'] != $_POST['confirmPassword'])
	{
		$_SESSION['password'] = true;
		header('Location: ../pages/createAccount.php');
		return ;
	}
	require_once '../function/AddUser.php';

	$_SESSION['loginValue'] = NULL;
	$_SESSION['emailValue'] = NULL;
    $_SESSION['passwordValue'] = NULL;
    $_SESSION['passwordUser'] = $_POST['password'];

	sendEmailVerification($_POST['email'], $_POST['login'], $token, $location);
	header('Location: ../pages/createAccount.php');
?>