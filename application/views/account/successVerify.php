<?php
	require 'application/config/database.php';
	require 'application/function/DbOperations.php';

	if (!empty($_GET) && isset($_GET['token']))
	{
		$UserInfo = CheckToken($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_GET['token']);

		if (!empty($UserInfo) && isset($UserInfo['token']))
		{
			UpdateUserVerify($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $UserInfo['id']);
		}
	}

	header('Location: /');
