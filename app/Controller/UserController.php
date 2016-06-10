<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationManager;
use Manager\UserManager;

class UserController extends Controller
{
	private $manager;
	private $authent;

	public function __construct() {
		$this->manager = new UserManager();
		$this->authent = new AuthentificationManager();
	}

	public function register()
	{
		// On réceptionne les données du formulaire
		$login = !empty($_POST['login']) ? strip_tags(trim($_POST['login'])) : '';
		$password = !empty($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
		$confirm_password = !empty($_POST['confirm_password']) ? strip_tags($_POST['confirm_password']) : '';

		$errors = array();
		$result = false;

		// Le formulaire a ete soumis, on a appuye sur le bouton Envoyer
		if (!empty($_POST)) {

			// On check les erreurs possibles
			if (empty($login) || !filter_var($login, FILTER_VALIDATE_EMAIL)) {
				$errors['login'] = 'Veuillez renseigner un email valide';
			}
			if (empty($password)) {
				$errors['password'] = 'Veuillez renseigner un mot de passe';
			} else if (strlen($password) < 8) {
				$errors['password'] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}
			if (!empty($password) && $password !== $confirm_password) {
				$errors['confirm_password'] = 'Les 2 mots de passe ne correspondent pas';
			}

			//debug($errors);

			// Aucune erreur dans le formulaire, tous les champs ont été saisis correctement
			if (empty($errors)) {

				$email_exists = $this->manager->emailExists($login);

				if (!empty($email_exists)) {
					$errors['login'] = 'Cet email est deja pris';
				} else {

					$crypted_password = password_hash($password, PASSWORD_BCRYPT);

					$user = $this->manager->insert(array(
						'email' => $login,
						'pass' => $crypted_password,
						'register_date' => date('Y-m-d H:i:s')
					));

					if (!empty($user)) {
						$this->authent->logUserIn($user);
						$result = true;
					} else {
						$errors['db_error'] = 'Erreur interne, merci de reessayer ulterieurement';
					}
				}
			}
		}

		$this->show('user/register', array(
			'errors' => $errors,
			'result' => $result,
			'login' => $login
		));
	}

	public function login()
	{
		// On réceptionne les données du formulaire
		$login = !empty($_POST['login']) ? strip_tags(trim($_POST['login'])) : '';
		$password = !empty($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';

		$errors = array();
		$result = false;

		// Le formulaire a ete soumis, on a appuye sur le bouton Envoyer
		if (!empty($_POST)) {

			// On check les erreurs possibles
			if (empty($login) || empty($password)) {
				$errors['login'] = 'Identifiants incorrects';
			}

			// Aucune erreur dans le formulaire, tous les champs ont été saisis correctement
			if (empty($errors)) {

				$user_id = $this->authent->isValidLoginInfo($login, $password);

				if (empty($user_id)) {
					$errors['login'] = 'Identifiants incorrects';
				} else {

					$user = $this->manager->find($user_id);

					if (!empty($user)) {
						$this->authent->logUserIn($user);
						$result = true;
					} else {
						$errors['db_error'] = 'Erreur interne, merci de reessayer ulterieurement';
					}
				}
			}
		}

		$this->show('user/login', array(
			'errors' => $errors,
			'result' => $result,
			'login' => $login
		));
	}

	public function logout()
	{
		// On détruit seulement les données user en session
		$this->authent->logUserOut();

		// On détruit toutes les variables dans $_SESSION
		session_unset();

		// On détruit la session côté serveur
		session_destroy();

		// On détruit le cookie de session côté client
		setcookie(session_name(), false, 1, '/');

		$this->redirectToRoute('user_login');
	}
}