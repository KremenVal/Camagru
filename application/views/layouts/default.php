<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/application/style/homePage.css">
	<script src="/application/scripts/allPhotos.js" ></script>
	<?php if ($this->route['controller'] == 'user')
	{
		echo '<link rel="stylesheet" type="text/css" href="/application/style/allPhotos.css">';
	} ?>
</head>
<body>
	<?php
	require 'application/views/layouts/header.php';
	$path = 'application/views/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';

	if (file_exists($path))
	{
		require $path;
	}
	?>
	<footer>Created by vkremen</footer>
</body>
</html>