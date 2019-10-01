<?php
	function SendEmailVerification(string $email, string $logging, string $token, string $location)
	{
		$Subject = "Camagru - Email verification";
		$Headers = 'MIME-Version: 1.0' . "\r\n";
		$Headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$Headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$Message = '
			<html>
			<head>
				<title>' . $Subject . '</title>
			</head>
			<body>
				Hello ' . htmlspecialchars($logging) . '!!!<br>
				To finalyze your subscribtion please click the link below <br>
				<a href="http://' . $location . '/account/successVerify?token=' . $token . '">Verify my email</a>
			</body>
			</html>
		';
		
		return mail($email, $Subject, $Message, $Headers);
	}

	function SendRecoverPassword(string $login, string $location, string $email, string $token)
	{
		$Subject = "Camagru - Recover password";
		$Headers = 'MIME-Version: 1.0' . "\r\n";
		$Headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$Headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$Message = '
				<html>
				<head>
					<title>' . $Subject . '</title>
				</head>
				<body>
					Hi ' . htmlspecialchars($login) . '.<br><br>
					If you did try to recover password: <br>
					Follow this <a href="http://' . $location . '/account/changePassword?token=' . $token . '">link</a> to reset your password.<br><br>
					If you didn’t try to recover password, just ignore this message.
				</body>
				</html>
			';

		return mail($email, $Subject, $Message, $Headers);
	}

	function SendAccountInfo(string $login, string $password, string $email)
	{
		$Subject = "Camagru - Account Info";
		$Headers = 'MIME-Version: 1.0' . "\r\n";
		$Headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$Headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$Message = '
				<html>
				<head>
					<title>' . $Subject . '</title>
				</head>
				<body>
					Your login: ' . htmlspecialchars($login) . '.<br>
					Your password: ' . htmlspecialchars($password) . '.<br>
				</body>
				</html>
			';

		return mail($email, $Subject, $Message, $Headers);
	}