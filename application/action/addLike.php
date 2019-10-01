<?php
	require 'application/config/database.php';
	require 'application/function/CheckLike.php';

	if (!empty($_GET) && isset($_GET['imageId']) && is_numeric($_GET['imageId'])
		&& !CheckLikes($_SESSION['user'], (int) $_GET['imageId'], $DB_DSN_CREATED, $DB_USER, $DB_PASSWORD))
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sqlInsertInto = 'INSERT INTO `like` (imageId, isLiked)
					value (:imageId, :isLiked)';
		$result = $pdo->prepare($sqlInsertInto);
		$result->execute([':imageId' => $_GET['imageId'],
			':isLiked' => $_SESSION['user']
		]);
		$result->closeCursor();
	}
	else
	{
		header('Location: /user/allPhotos');
	}
