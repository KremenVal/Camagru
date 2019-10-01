<?php
	function AddUser($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Token)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare('INSERT INTO users (login, email, password, passwordForUser, token)
                value (:login, :email, :password, :passwordForUser, :token)');
		$Result->execute([':login' => $_POST['login'],
			':email' => $_POST['email'],
			':password' => hash('whirlpool', $_POST['password']),
			':token' => $Token
		]);
		$Result->closeCursor();
	}

	function CheckLogin($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Login)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT login FROM users WHERE login=:login");
		$Result->execute(array('login' => $Login));
		$Login = $Result->fetch(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		return $Login;
	}

	function CheckEmail($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Email)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT email FROM users WHERE email=:email");
		$Result->execute(array(':email' => $Email));
		$Email = $Result->fetch(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		return $Email;
	}

	function FindTokenByEmail($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Email)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare('SELECT * FROM users  WHERE email=:email');
		$Result->execute(array('email' => $Email));
		$UserInfo = $Result->fetch(PDO::FETCH_ASSOC);

		return $UserInfo;
	}

	function CheckToken($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Token)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare('SELECT * FROM users  WHERE token=:token');
		$Result->execute(array('token' => $Token));
		$UserInfo = $Result->fetch(PDO::FETCH_ASSOC);

		return $UserInfo;
	}

	function UpdatePassword($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Password, $Token)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("UPDATE users SET password=:password WHERE token=:token");
		$Result->execute(array(':password' => hash('whirlpool', $Password),
			':token' => $Token));
		$Result->closeCursor();
	}

	function UpdateUserVerify($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Id)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("UPDATE users SET verification='Y' WHERE id=:id");
		$Result->execute(array('id' => $Id));
		$Result->closeCursor();
	}

	function GetUserInfo($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $LoginOrEmail)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result= $PDO->prepare("SELECT * FROM users WHERE ((email=:email) OR (login=:login))");
		$Result->execute(array(':email' => $LoginOrEmail,
			':login' => $LoginOrEmail));
		$UserInfo = $Result->fetch();
		$Result->closeCursor();

		return $UserInfo;
	}

	function GetImageInfo($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $LimitStart, $LimitEnd)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT login, image, image.id FROM `image`
			INNER JOIN `users` ON `image`.`userId` = `users`.`id` 
			ORDER BY `image`.`createsAt` DESC LIMIT " . $LimitStart . ',' . $LimitEnd);
		$Result->execute();
		$ImageInfo = $Result->fetchAll(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		return $ImageInfo;
	}

	function GetComments($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT * FROM `comment`
			ORDER BY `comment`.`createdAt` ASC");
		$Result->execute();
		$Comments = $Result->fetchAll(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		return $Comments;
	}

	function CountNumberLikes($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Id)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT count(*) AS number FROM `like` WHERE imageId=:id");
		$Result->execute(array(':id' => $Id));
		$NumberLikes = $Result->fetchAll(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		return $NumberLikes[0]['number'];
	}

	function CheckLikes($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $Id, $User)
	{
		$PDO = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Result = $PDO->prepare("SELECT imageId FROM `like` WHERE isLiked=:isLiked");
		$Result->execute(array(':isLiked' => $User));
		$ImageInfo = $Result->fetchAll(PDO::FETCH_ASSOC);
		$Result->closeCursor();

		foreach ($ImageInfo as $Info)
		{
			if ($Info['imageId'] == $Id)
			{
				return true;
			}
		}

		return false;
	}