<?php
namespace Model;

use \Exception;
use Core\Utils;

class Movie extends \Core\Model {

	private $id;
	protected $slug;
	protected $title;
	protected $year;
	protected $genres;
	protected $synopsis;
	protected $directors;
	protected $actors;
	protected $writers;
	protected $runtime;
	protected $mpaa;
	protected $rating;
	protected $popularity;
	protected $modified;
	protected $created;
	protected $poster_flag;
	protected $cover;

	/* Getters */
	public function getId() {
		return $this->id;
	}
	public function getSlug() {
		return $this->slug;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getYear() {
		return $this->year;
	}
	public function getGenres() {
		return $this->genres;
	}
	public function getSynopsis($max_length = 0, $end = '...') {
		if ($max_length === 0) {
			return nl2br($this->synopsis);
		}
		return Utils::cutString($this->synopsis, $max_length, $end);
	}
	public function getDirectors() {
		return $this->directors;
	}
	public function getActors() {
		return $this->actors;
	}
	public function getWriters() {
		return $this->writers;
	}
	public function getRuntime() {
		return $this->runtime;
	}
	public function getMpaa() {
		return $this->mpaa;
	}
	public function getRating() {
		return $this->rating;
	}
	public function getPopularity() {
		return $this->popularity;
	}
	public function getModified() {
		return $this->modified;
	}
	public function getCreated() {
		return $this->created;
	}
	public function getPosterFlag() {
		return $this->poster_flag;
	}
	public function getCover() {
		return $this->cover;
	}

	/* Setters */
	public function setId($id) {
		$this->id = $id;
	}
	public function setSlug($slug) {
		$this->slug = $slug;
	}
	public function setTitle($title) {
		if (empty($title) || strlen($title) > 255) {
			throw new Exception('Le titre est obligatoire');
		}
		$this->title = $title;
	}
	public function setYear($year) {
		if (empty($year) || !is_numeric($year)) {
			throw new Exception('Une année valide est obligatoire');
		}
		$this->year = $year;
	}
	public function setGenres($genres) {
		$this->genres = $genres;
	}
	public function setSynopsis($synopsis) {
			$this->synopsis = $synopsis;
	}
	public function setDirectors($directors) {
		$this->directors = $directors;
	}
	public function setActors($actors) {
		$this->actors = $actors;
	}
	public function setWriters($writers) {
		$this->writers = $writers;
	}
	public function setRuntime($runtime) {
		$this->runtime = $runtime;
	}
	public function setMpaa($mpaa) {
		$this->mpaa = $mpaa;
	}
	public function setRating($rating) {
		$this->rating = $rating;
	}
	public function setPopularity($popularity) {
		$this->popularity = $popularity;
	}
	public function setModified($modified) {
		$this->modified = $modified;
	}
	public function setCreated($created) {
		$this->created = $created;
	}
	public function setPosterFlag($poster_flag) {
		$this->poster_flag = $poster_flag;
	}
	public function setCover($cover) {
		$this->cover = $cover;
	}

}
