<?php $this->layout('admin/layout', ['title' => 'Movie catalog']) ?>

<?php
$this->start('main_content');
?>
	<?= $this->fetch('movie/partials/navbar'); ?>

	<h1><?= count($movies) ?> film(s)</h1>
	<hr>

	<?php foreach($movies as $movie) { ?>
		<h2><?= $movie->title ?></h2>
		<blockquote><?= $movie->getSynopsis(50, ' [...]') ?></blockquote>
		<a href="<?= $this->url('movie_view', array('id' => $movie->id)) ?>">Voir la fiche du film</a>
		<hr>
	<?php } ?>

<?php
$this->stop('main_content');