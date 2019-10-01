<?php
    require 'application/config/database.php';
    require 'application/function/EmailFunction.php';
    require 'application/function/DbOperations.php';

    if (empty($_POST) || !empty($_GET))
	{
		header('Location: /');
	}

    if ($_POST['password'] != $_POST['confirmPassword'])
    {
        header('Location: /account/changePassword?token=' . $_POST['token']);
        return ;
    }

	$UserInfo = CheckToken($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['token']);

    if (!empty($UserInfo) && isset($UserInfo['token']) && $_POST['token'] == $UserInfo['token'])
	{
		UpdatePassword($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['password'], $_POST['token']);
	}
    else
	{
		header('Location: /');
	}

    SendAccountInfo($UserInfo['login'], $_POST['password'], $UserInfo['email']);
    header('Location: /');