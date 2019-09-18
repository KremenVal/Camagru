<?php


	namespace application\core;


	abstract class Controller
	{
		public $route;
		public $view;
		public $get;

		public function __construct($route, $path, $get)
		{
			$this->route = $route;	//Записываем массив с контролером и действием
			$this->view = new View($route);	//Создаем объет вил в зависимости от полученных путей
			$this->get = $get;

			if (method_exists($path, 'before'))	//Вызываем у каждого контролера свой метод стилизации
			{
				$this->before();	//Сам метод стилизации
			}
		 }
	}