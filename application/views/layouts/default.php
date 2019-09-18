<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/application/style/homePage.css">
	<?php if ($this->route['controller'] == 'user')
	{
		echo '<link rel="stylesheet" type="text/css" href="/application/style/allPhotos.css">';
	} ?>
</head>
<body>
	<?php
	$path = 'application/views/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';

	if (file_exists($path))
	{
		require $path;
	}
	?>
</body>
</html>