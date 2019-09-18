<?php
	require 'application/config/database.php';
	require 'application/action/sendAccountInfo.php';

	if (isset($_GET['token']) && $_GET['token'])
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$result = $pdo->prepare('SELECT * FROM users  WHERE token=:token');
		$result->execute(array('token' => $_GET['token']));
		$valueToken = $result->fetch();
		$result->closeCursor();

		if ($valueToken)
		{
			$result = $pdo->prepare("UPDATE users SET verification='Y' WHERE id=:id");
			$result->execute(array('id' => $valueToken['id']));
			$result->closeCursor();

			sendAccountInfo($valueToken['login'], $valueToken['passwordForUser'], $valueToken['email']);

			$_SESSION['passwordUser'] = null;
		}
	}

	header('Location: /');
