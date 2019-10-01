<?php
    require 'application/config/database.php';
    require 'application/function/DbOperations.php';

	if (isset($_SESSION['logIn']) && isset($_SESSION['user']) && isset($_SESSION['idUser'])
		&& !empty($_SESSION['logIn']) && !empty($_SESSION['idUser']) && !empty($_SESSION['user']))
	{
		header('Location: /user/allPhotos');
	}

	$UserInfo = GetUserInfo($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_POST['loginOrEmail']);

	if (!empty($UserInfo))
	{
		$_SESSION['email'] = $UserInfo['email'];
		$_SESSION['user'] = $UserInfo['login'];
		$_SESSION['idUser'] = $UserInfo['id'];
		$_SESSION['password'] = $_POST['password'];
	}

    if ($UserInfo['verification'] == 'N')
    {
        header('Location: /');
    }
    else if ($UserInfo['verification'] == 'Y' && $UserInfo['password'] == hash('whirlpool', $_POST['password']))
    {
        $_SESSION['logIn'] = true;
        unset($_SESSION['emailValue']);
        unset($_SESSION['loginValue']);
        unset($_SESSION['passwordUser']);
		header('Location: /user/allPhotos');
    }
    else
	{
		header('Location: /');
	}
