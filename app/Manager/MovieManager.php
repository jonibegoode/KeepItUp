<?php /* app/Manager/MovieManager.php */
namespace Manager;

use \Core\Db;
use \Core\Utils;
use \Model\Movie;

class MovieManager extends \W\Manager\Manager
{
	public function find($id) {
		$movie = parent::find($id);
		if (!empty($movie)) {
			return new Movie($movie);
		}
		return false;
	}

	public function findAll($orderBy = '', $orderDir = 'ASC', $limit = NULL, $offset = NULL) {
		$results = parent::findAll($orderBy, $orderDir, $limit, $offset);
		$items = array();
		foreach($results as $result) {
			$items[] = new Movie($result);
		}
		return $items;
	}

	public function getRandom()	{
		return Movie::get('SELECT * FROM '. $this->table .' ORDER BY RAND() LIMIT 1');
	}

	public function search($search) {
		return Movie::getList('SELECT * FROM '. $this->table .' WHERE title LIKE :search OR synopsis LIKE :search', array('search' => '%'.$search.'%'));
	}

	public function save(Movie $movie) {

		/*
		$bindings = array();
		foreach($movie->getProperties() as $field => $value) {
			$bindings[$field] = $value;
		}
		*/

		$bindings = array(
			':slug' => $movie->slug,
			':title' => $movie->title,
			':year' => $movie->year,
			':genres' => $movie->genres,
			':synopsis' => $movie->synopsis,
			':directors' => $movie->directors,
			':actors' => $movie->actors,
			':writers' => $movie->writers,
			':runtime' => $movie->runtime,
			':mpaa' => $movie->mpaa,
			':rating' => $movie->rating,
			':popularity' => $movie->popularity,
			':poster_flag' => $movie->poster_flag,
			':cover' => $movie->cover,
		);

		return Db::insert('INSERT INTO '.$this->table.' SET slug = :slug, title = :title, year = :year, genres = :genres, synopsis = :synopsis, directors = :directors, actors = :actors, writers = :writers, runtime = :runtime, mpaa = :mpaa, rating = :rating, popularity = :popularity, modified = NOW(), created = NOW(), poster_flag = :poster_flag, cover = :cover', $bindings);
	}

}
