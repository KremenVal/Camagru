<?php
	function sendAccountInfo(string $login, string $password, string $email)
	{
		$subject = "Camagru - Account Info";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$message = '
			<html>
			<head>
				<title>' . $subject . '</title>
			</head>
			<body>
				Your login: ' . htmlspecialchars($login) . '.<br>
				Your password: ' . htmlspecialchars($password) . '.<br>
			</body>
			</html>
		';
		
		return mail($email, $subject, $message, $headers);
	}