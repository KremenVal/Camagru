<?php

	require 'application/config/database.php';
	require 'application/function/CheckLike.php';

	if (!empty($_GET) && CheckLikes($_SESSION['user'], $_GET['imageId'], $DB_DSN_CREATED, $DB_USER, $DB_PASSWORD))
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result= $pdo->prepare("DELETE FROM `like` WHERE ((imageId=:imageId) AND (isLiked=:isLiked))");
		$result->execute(array(':imageId' => $_GET['imageId'],
			':isLiked' => $_SESSION['user']));
		$result->closeCursor();
	}
	else
	{
		header('Location: /user/allPhotos');
	}
