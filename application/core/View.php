<?php

	namespace application\core;


	class View
	{
		public $path;
		public $route;
		public $layout = 'default';

		public function __construct($route)
		{
			$this->route = $route;
			$this->path = $route['controller'] . '/' . $route['action'];
		}

		public function render($title, $vars = [])
		{
			extract($vars);

			if (strstr($this->path, 'action/'))
			{
				$path = 'application/' . $this->path . '.php';
			}
			else
			{
				$path = 'application/views/' . $this->path . '.php';
			}

			if (file_exists($path))
			{
				ob_start();

				require $path;

				ob_get_clean();

				require 'application/views/layouts/' . $this->layout . '.php';
			}
		}

		public static function ErrorCode($code)
		{
			http_response_code($code);

			$path = 'application/views/errors/' . $code . '.php';

			if (file_exists($path))
			{
				require $path;
			}

			exit();
		}

		public function redirect($url)
		{
			header('Location: ' . $url);

			exit();
		}
	}