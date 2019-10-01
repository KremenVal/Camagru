<?php

	namespace application\controllers;

	use application\core\Controller;

	class ActionController extends Controller
	{
		public function logOutAction()
		{
			$this->view->render('Create');
		}

		public function nextOrPreviousPageAction()
		{
			$this->view->render('Create');
		}

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

		public function getCommentAction()
		{
			$this->view->render('Main page');
		}

		public function addLikeAction()
		{
			$vars = [];

			if ($this->get)
			{
				$temp = explode('&', $this->get);

				foreach ($temp as $value)
				{
					$value = explode('=', $value);

					if (isset($value[1]))
					{
						$vars[$value[0]] = $value[1];
					}
					else
					{
						$vars[$value[0]] = null;
					}
				}
			}

			$this->view->render('Add Like', $vars);
		}

		public function deleteLikeAction()
		{
			$vars = [];

			if ($this->get)
			{
				$temp = explode('&', $this->get);

				foreach ($temp as $value)
				{
					$value = explode('=', $value);

					if (isset($value[1]))
					{
						$vars[$value[0]] = $value[1];
					}
					else
					{
						$vars[$value[0]] = null;
					}
				}
			}

			$this->view->render('Delete Like', $vars);
		}

		public function addCommentAction()
		{
			$vars = [];

			if ($this->get)
			{
				$temp = explode('&', $this->get);

				foreach ($temp as $value)
				{
					$value = explode('=', $value);

					if (isset($value[1]))
					{
						$vars[$value[0]] = $value[1];
					}
					else
					{
						$vars[$value[0]] = null;
					}
				}
			}

			$this->view->render('Delete Like', $vars);
		}
	}