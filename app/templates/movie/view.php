<?php $this->layout('admin/layout', ['title' => 'Movie view']) ?>

<?php $this->start('main_content') ?>

	<?= $this->fetch('movie/partials/navbar'); ?>

	<h1><?= $movie->title ?></h1>

	<?php foreach($movie->getProperties() as $key => $val) { ?>
	<?= $key ?> : <big><?= $movie->$key ?></big><br>
	<?php } ?>

<?php $this->stop('main_content') ?>