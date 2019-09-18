<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
    require 'application/config/database.php';

	if (isset($_SESSION['logIn']) && $_SESSION['logIn'] && isset($_SESSION['idUser']))
	{
		header('Location: /user/allPhotos');
	}

	$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);

    if (strpos($_POST['loginOrEmail'], '@'))
	{
		$query= $pdo->prepare("SELECT * FROM users WHERE email=:email");
		$query->execute(array(':email' => $_POST['loginOrEmail']));
		$val = $query->fetch();
	}
    else
	{
		$query= $pdo->prepare("SELECT * FROM users WHERE login=:login");
		$query->execute(array(':login' => $_POST['loginOrEmail']));
		$val = $query->fetch();
	}

    if ($val['verification'] == 'N')
    {
        $_SESSION['loginOrEmail'] = $_POST['loginOrEmail'];
        header('Location: /');
    }
    else if ($val['verification'] == 'Y' && $val['password'] == hash('whirlpool', $_POST['password']))
    {
        $_SESSION['logIn'] = true;
        $_SESSION['idUser'] = $val['id'];
		$_SESSION['loginOrEmail'] = null;
		header('Location: /user/allPhotos');
    }
    else
	{
		$_SESSION['loginOrEmail'] = $_POST['loginOrEmail'];
		header('Location: /');
	}
