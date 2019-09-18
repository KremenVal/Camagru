<?php

	namespace application\controllers;

	use application\core\Controller;

	class AccountController extends Controller
	{
		 public function forgotAction()
		 {
		 	$this->view->render('Forgot password?');
		 }

		 public function registerAction()
		 {
		 	$this->view->render('Sign up');
		 }

		public function successVerifyAction()
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

			$this->view->render('Success Verify', $vars);
		}

		public function changePasswordAction()
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
			$this->view->render('Change Password');
		}
	}