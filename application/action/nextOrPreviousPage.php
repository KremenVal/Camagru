<?php
	if (!empty($_GET) && isset($_GET['nextPage']) && $_GET['nextPage'] == 1 && isset($_SESSION['LimitStart'])
		&& isset($_SESSION['LimitEnd']))
	{
		$_SESSION['LimitStart'] += 5;
		$_SESSION['LimitEnd'] += 5;
	}
	else if (!empty($_GET) && isset($_GET['previousPage']) && $_GET['previousPage'] == 0 && isset($_SESSION['LimitStart'])
		&& isset($_SESSION['LimitEnd']))
	{
		if (!$_SESSION['LimitStart'])
		{
			if ($_SESSION['LimitEnd'] != 5)
			{
				$_SESSION['LimitEnd'] = 5;
			}
		}

		$_SESSION['LimitStart'] -= 5;
		$_SESSION['LimitEnd'] -= 5;
	}
	else if (!empty($_GET) && isset($_GET['firstPage']) && $_GET['firstPage'] == 1)
	{
		$_SESSION['LimitStart'] = 0;
		$_SESSION['LimitEnd'] = 5;
	}

	header('Location: /user/allPhotos');