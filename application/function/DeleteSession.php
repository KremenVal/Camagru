<?php
	foreach ($_SESSION as $key => $value)
	{
		if ($key != 'loginOrEmail')
		{
			unset($_SESSION[$key]);
		}
	}
