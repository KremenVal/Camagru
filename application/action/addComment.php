<?php
	require 'application/config/database.php';

	if (!empty($_POST) && isset($_POST['imageId']) && is_numeric($_POST['imageId'])
		&& isset($_POST['comment']) && is_string($_POST['comment']))
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sqlInsertInto = 'INSERT INTO `comment` (imageId, comment, isLiked)
						value (:imageId, :comment, :isLiked)';
		$result = $pdo->prepare($sqlInsertInto);
		$result->execute([':imageId' => $_POST['imageId'],
			':comment' => $_POST['comment'],
			':isLiked' => $_SESSION['user']
		]);
		$result->closeCursor();
	}
	header('Location: /user/allPhotos');