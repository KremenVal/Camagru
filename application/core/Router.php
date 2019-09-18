<?php

	namespace application\core;

	class Router
	{
		protected $routes = [];
		protected $params = [];
		protected $get;

		public function __construct()
		{
			$arr = require_once 'application/config/routes.php';

			foreach ($arr as $key => $value) //Добавляем в переменную $this->routes ключ - регулярку пату, значение действия
			{
				$this->add($key, $value);
			}
		}

		public function add($route, $params)
		{
			$route = '#^' . $route . '$#';
			$this->routes[$route] = $params;
		}

		public function match()
		{
			if (strpos($_SERVER['REQUEST_URI'], '?'))
			{
				$url = trim(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')), '/');
				$this->get = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1);
			}
			else
			{
				$url = trim($_SERVER['REQUEST_URI'], '/');
				$this->get = '';
			}


			foreach ($this->routes as $route => $params) //Ищем совпадения из наших путей по УРЛ который к нам пришел
			{
				if (preg_match($route, $url, $matches))
				{
					$this->params = $params;

					return true;
				}
			}

			return false;
		}

		public function run()
		{
			if ($this->match())
			{
				$path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller'; //Делаем неймспейс для классов

				if (class_exists($path))
				{
					$action = $this->params['action'] . 'Action';

					if (method_exists($path, $action))
					{
						$controller = new $path($this->params, $path, $this->get);
						$controller->$action();
					}
					else
					{
						View::ErrorCode(404);
					}
				}
				else
				{
					View::ErrorCode(404);
				}
			}
			else
			{
				View::ErrorCode(404);
			}
		}
	}