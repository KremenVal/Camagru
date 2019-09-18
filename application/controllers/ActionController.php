<?php

	namespace application\controllers;

	use application\core\Controller;

	class ActionController extends Controller
	{
		 public function actionCreateAction()
		 {
		 	$this->view->render('Create');
		 }

		 public function actionRecoverPasswordAction()
		 {
		 	$this->view->render('Recover');
		 }

		public function changePasswordAction()
		{
			$this->view->render('Change');
		}

		public function actionHomeAction()
		{
			$this->view->render('Main page');
		}
	}