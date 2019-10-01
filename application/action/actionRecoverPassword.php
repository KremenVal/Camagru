<?php
    require 'application/config/database.php';
    require 'application/function/EmailFunction.php';
    require 'application/function/DbOperations.php';

    if (empty($_POST) || !empty($_GET))
	{
		header('Location: /account/forgot');
		return;
	}

	$_SESSION['emailValue'] = $_POST['email'];
    $Email = CheckEmail($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['email']);

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        header('Location: /account/forgot');
        return ;
    }
    else if (!isset($Email['email']))
    {
        header('Location: /account/forgot');
        return ;
    }

	$Location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionRecoverPassword.php", "",
			$_SERVER['REQUEST_URI']);
    $UserInfo = FindTokenByEmail($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['email']);
	SendRecoverPassword($UserInfo['login'], $Location, $_POST['email'], $UserInfo['token']);

	$_SESSION['emailValue'] = NULL;

	header('Location: /');