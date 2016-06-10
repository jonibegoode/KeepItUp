<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationManager;

class AdminController extends Controller
{

	public function dashboard()
	{
		$loggedUser = $this->getUser();

		if (empty($loggedUser)) {
			$this->redirectToRoute('user_login');
		}

		$this->show('admin/dashboard');
	}

}