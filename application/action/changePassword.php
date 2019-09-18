<?php
    require 'application/config/database.php';
    require 'application/action/sendAccountInfo.php';

    if (empty($_POST) || !empty($_GET))
	{
		header('Location: /');
	}

    if ($_POST['password'] != $_POST['confirmPassword'])
    {
        header('Location: /account/changePassword?token=' . $_POST['token']);
        return ;
    }

    $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
	$result = $pdo->prepare('SELECT * FROM users  WHERE token=:token');
	$result->execute(array('token' => $_POST['token']));
	$valueToken = $result->fetch();

    $result= $pdo->prepare("UPDATE users SET password=:password, passwordForUser=:passwordForUser WHERE id=:id");
    $result->execute(array(':password' => hash('whirlpool', $_POST['password']),
		':passwordForUser' => $_POST['password'],
		':id' => $valueToken['id']));
    $result->closeCursor();
    $_SESSION['passwordUser'] = null;

    sendAccountInfo($valueToken['login'], $_POST['password'], $valueToken['email']);
    header('Location: /');