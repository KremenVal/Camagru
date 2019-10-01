<?php
	require 'application/config/database.php';
    require 'application/function/EmailFunction.php';
	require 'application/function/DbOperations.php';

	if (empty($_POST) || !isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['password'])
		|| !isset($_POST['confirmPassword']) || !isset($_POST['SignUp']) || !empty($_GET))
	{
		header('Location: /account/register');
		return ;
	}

	$Login = CheckLogin($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['login']);
	$Email = CheckEmail($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['email']);
	$_SESSION['emailValue'] = $Email['email'];
	$_SESSION['loginValue'] = $Login['login'];

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
	else if (!empty($Login) && isset($Login['login']) && mb_strtolower($Login['login']) == mb_strtolower($_POST['login']))
    {
        header('Location: /account/register');
        return ;
    }

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		header('Location: /account/register');
		return ;
	}
	else if ($Email['email'])
    {
        header('Location: /account/register');
        return ;
    }

	if ($_POST['password'] != $_POST['confirmPassword'])
	{
		header('Location: /account/register');
		return ;
	}

	$_SESSION['loginValue'] = NULL;
	$_SESSION['emailValue'] = NULL;
	$_SESSION['user'] = $Login['login'];
	$_SESSION['email'] = $Email['email'];
	$_SESSION['password'] = $_POST['password'];
	$Token = uniqid(rand(), true);
	$Location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionCreate", "", $_SERVER['REQUEST_URI']);

	AddUser($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Token);
	SendEmailVerification($_POST['email'], $_POST['login'], $Token, $Location);
	SendAccountInfo($_POST['login'], $_POST['password'], $_POST['email']);

	header('Location: /');