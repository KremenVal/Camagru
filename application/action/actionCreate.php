<?php
    $_SESSION['loginValue'] = $_POST['login'];
    $_SESSION['emailValue'] = $_POST['email'];

	require 'application/config/database.php';
    require 'sendEmailVerification.php';
    require 'application/function/CheckUser.php';

	if (empty($_POST) || !isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['password'])
		|| !isset($_POST['confirmPassword']) || !isset($_POST['SignUp']) || !empty($_GET))
	{
		header('Location: /account/register');
		return ;
	}

	if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 30)
	{
		header('Location: /account/register');
		return ;
	}
	else if (preg_match('/[^A-Za-z0-9]/', $_POST['login']))
	{
		header('Location: /account/register');
		return ;
	}
	else if ($loginExist)
    {
        header('Location: /account/register');
        return ;
    }

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		header('Location: /account/register');
		return ;
	}
	else if ($valEmail['email'])
    {
        header('Location: /account/register');
        return ;
    }

	if ($_POST['password'] != $_POST['confirmPassword'])
	{
		header('Location: /account/register');
		return ;
	}

	require 'application/function/AddUser.php';

	$_SESSION['loginValue'] = NULL;
	$_SESSION['emailValue'] = NULL;

	sendEmailVerification($_POST['email'], $_POST['login'], $token, $location);
	header('Location: /');