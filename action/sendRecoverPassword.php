<?php
	function sendRecoverPassword(string $login, string $location, string $email, string $token)
	{
		$subject = "Camagru - Recover password";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$message = '
			<html>
			<head>
				<title>' . $subject . '</title>
			</head>
			<body>
				Hi ' . htmlspecialchars($login) . '.<br><br>
				If you did try to recover password: <br>
				Follow this <a href="http://' . $location . '/pages/changePassword.php?token=' . $token . '">link</a> to reset your password.<br><br>
				If you didn’t try to recover password, just ignore this message.
			</body>
			</html>
		';
		
		return mail($email, $subject, $message, $headers);
	}
?>