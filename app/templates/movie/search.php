<?php $this->layout('admin/layout', ['title' => 'Movie search']) ?>

<?php
$this->start('main_content');
?>
	<?= $this->fetch('movie/partials/navbar'); ?>

	<h1>Recherche</h1>
	<form action="<?= $this->url('movie_search_results', array('search' => '')) ?>" onsubmit="location.href = this.action + document.getElementById('search').value; return false;">
		<input type="text" id="search" name="search" placeholder="Rechercher..." value="<?= $search ?>">
		<input type="submit" value="Recherche">
	</form>

	<?php if (!empty($search)): ?>
	<h2><?= count($movies) ?> résultat(s) pour la recherche &laquo; <?= $search ?> &raquo; </h2>
	<hr>

		<?php foreach($movies as $movie): ?>
			<h3><?= $movie->title ?></h3>
			<blockquote><?= $movie->getSynopsis(50, ' [...]') ?></blockquote>
			<a href="<?= $this->url('movie_view', array('id' => $movie->id)) ?>">Voir la fiche du film</a>
			<hr>
		<?php endforeach ?>

	<?php endif ?>

<?php
$this->stop('main_content');