<?php $this->layout('admin/layout', ['title' => 'Movie add']) ?>

<?php $this->start('main_content') ?>

	<?php $this->fetch('movie/partials/navbar'); ?>

	<h1>Ajouter un film</h1>

	<?php if (!empty($result)) { ?>
	<div class="alert alert-success">Votre film a bien été envoyé</div>
	<script>setTimeout(function() { location.href = "<?= $this->url('movie_view', array('id' => $result)) ?>"; }, 3000);</script>
	<?php } else { ?>

	<?php if (!empty($errors)) { ?>
	<div class="alert alert-danger">
		<ul>
		<?php
		foreach($errors as $error) {
			echo '<li>'.$error.'</li>';
		}
		?>
		</ul>
	</div>
	<?php } ?>

	<form method="POST">
		<?php foreach($movie->getProperties() as $field => $value) { ?>
		<label for="<?= $field ?>"><?= ucfirst(\Core\Utils::getCamelCase($field)) ?></label> :
		<input type="text" size="50" id="<?= $field ?>" name="<?= $field ?>" value="<?= $value ?>">
		<br>
		<?php } ?>
		<hr>
		<input type="submit" value="Envoyer">
	</form>

	<?php } ?>

<?php $this->stop('main_content') ?>