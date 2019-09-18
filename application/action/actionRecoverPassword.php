<?php
    $_SESSION['emailValue'] = $_POST['email'];

    require 'application/config/database.php';
    require 'sendRecoverPassword.php';
    require 'application/function/CheckUser.php';

    if (empty($_POST) || !empty($_GET))
	{
		header('Location: /account/forgot');
		return;
	}

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        header('Location: /account/forgot');
        return ;
    }
    else if (!$valEmail['email'])
    {
        header('Location: /account/forgot');
        return ;
    }

	$location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionRecoverPassword.php", "",
			$_SERVER['REQUEST_URI']);
	$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
	$result= $pdo->prepare('SELECT * FROM users  WHERE email=:email');
	$result->execute(array('email' => $_POST['email']));
	$valueInfo = $result->fetch();

	sendRecoverPassword($valueInfo['login'], $location, $_POST['email'], $valueInfo['token']);

	$result->closeCursor();
	$_SESSION['emailValue'] = NULL;

	header('Location: /');