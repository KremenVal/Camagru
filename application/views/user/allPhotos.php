<h1>All photos</h1>
<div class="container">
	<?php
		require 'application/config/database.php';

		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result= $pdo->prepare("SELECT login, image FROM `image`
											INNER JOIN `users` ON `image`.`userId` = `users`.`id`
											ORDER BY `image`.`createsAt` DESC");
		$result->execute();
		$valLogin = $result->fetchAll(PDO::FETCH_ASSOC);
		$result->closeCursor();

		foreach ($valLogin as $image):
	?>
	<div class="picgallery">
		<div class="login"><?php echo $image['login']; ?></div>
		<img class="pic" src="<?php echo $image['image']; ?>">
	</div>
	<?php endforeach; ?>
</div>