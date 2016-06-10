<?php

namespace Controller;

use \Exception;
use \W\Controller\Controller;
use \Manager\MovieManager;
use \Model\Movie;

class MovieController extends Controller
{
	private $manager;

	public function __construct() {
		$this->manager = new MovieManager();
	}

	public function view($id)
	{
		$movie = $this->manager->find($id);

		if (empty($movie)) {
			$this->redirectToRoute('404');
		}

		$this->show('movie/view', array('movie' => $movie));
	}

	public function random()
	{
		$movie = $this->manager->getRandom();

		$this->show('movie/view', array('movie' => $movie));
	}

	public function catalog()
	{
		$movies = $this->manager->findAll();

		$this->show('movie/catalog', array('movies' => $movies));
	}

	public function search($search = '') {

		$movies = array();
		if (!empty($search)) {

			$search = htmlspecialchars($search);
			$search = urldecode($search);

			$movies = $this->manager->search($search);
		}

		$this->show('movie/search', array('search' => $search, 'movies' => $movies));
	}

	public function add()
	{
		$title = !empty($_POST['title']) ? strip_tags($_POST['title']) : '';
		$synopsis = !empty($_POST['synopsis']) ? strip_tags($_POST['synopsis']) : '';

		$errors = array();
		$result = false;

		$movie = new Movie();

		if (!empty($_POST)) {

			try {
				foreach($movie->getProperties() as $field => $_value) {
					$value = !empty($_POST[$field]) ? strip_tags($_POST[$field]) : '';
					$movie->$field = $value;
				}
			} catch (Exception $e) {
				$errors[$field] = $e->getMessage();
			}

			if (empty($errors)) {
				$result = $this->manager->save($movie);
				if (empty($result)) {
					$errors['db'] = 'Erreur interne, merci de réessayer ultérieurement';
				}
			}
		}

		$this->show('movie/add', array(
			'errors' => $errors,
			'result' => $result,
			'movie' => $movie,
		));
	}

}