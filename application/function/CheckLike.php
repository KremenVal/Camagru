<?php

	function CheckLikes(string $user, int $id, $DB_DSN_CREATED, $DB_USER, $DB_PASSWORD)
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result= $pdo->prepare("SELECT imageId FROM `like` WHERE isLiked=:isLiked");
		$result->execute(array(':isLiked' => $user));
		$valLogin = $result->fetchAll(PDO::FETCH_ASSOC);
		$result->closeCursor();

		foreach ($valLogin as $value)
		{
			if ($value['imageId'] == $id)
			{
				return true;
			}
		}

		return false;
	}