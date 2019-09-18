<?php

	namespace application\controllers;

	use application\core\Controller;

	class UserController extends Controller
	{
		public function allPhotosAction()
		{
			$this->view->render('All Photos');
		}
	}