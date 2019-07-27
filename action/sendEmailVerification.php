<?php
	function sendEmailVerification(string $email, string $logging, string $token, string $location)
	{
		$subject = "Camagru - Email verification";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: <vkremen@student.42.fr>' . "\r\n";

		$message = '
			<html>
			<head>
				<title>' . $subject . '</title>
			</head>
			<body>
				Hello ' . htmlspecialchars($logging) . ' </br>
				To finalyze your subscribtion please click the link below </br>
				<a href="http://' . $location . '/pages/homePage.php?token=' . $token . '">Verify my email</a>
			</body>
			</html>
		';
		
		return mail($email, $subject, $message, $headers);
	}
?>