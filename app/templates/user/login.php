<?php $this->layout('layout', ['title' => 'Connexion']) ?>

<?php $this->start('main_content') ?>

<?php if ($result === true) { ?>
<div class="alert alert-success">Connexion réussie</div>
<script>setTimeout(function() { location.href = "<?= $this->url('admin_dashboard') ?>"; }, 2000);</script>
<?php } else { ?>

<h1>Connexion</h1>

<form method="POST">

	<?php if (!empty($errors['login'])) { ?>
	<div class="alert alert-danger">
		<?= $errors['login'] ?>
	</div>
	<?php } ?>

	Login : <input type="text" size="20" maxlength="100" id="login" name="login" value="<?= $login ?>">
	<br><br>

	Mot de passe : <input type="password" size="20" name="password">
	<br><br>

	<input type="submit" value="Connexion">

</form>

<?php } ?>

<?php $this->stop('main_content') ?>