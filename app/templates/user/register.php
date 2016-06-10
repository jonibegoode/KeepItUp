<?php $this->layout('layout', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>

<?php if ($result === true) { ?>
<div class="alert alert-success">Inscription réussie</div>
<script>setTimeout(function() { location.href = "<?= $this->url('admin_dashboard') ?>"; }, 2000);</script>
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

<h1>Inscription</h1>

<form method="POST">

	Login : <input type="text" size="20" maxlength="100" id="login" name="login" value="<?= $login ?>">
	<span style="color: red"><?= !empty($errors['login']) ? $errors['login'] : '' ?></span>
	<br><br>

	Mot de passe : <input type="password" size="20" name="password">
	<span style="color: red"><?= !empty($errors['password']) ? $errors['password'] : '' ?></span>
	<br><br>

	Confirmation du mot de passe : <input type="password" size="20" name="confirm_password">
	<span style="color: red"><?= !empty($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>
	<br><br>

	<input type="submit" value="Inscription">

</form>

<?php } ?>

<?php $this->stop('main_content') ?>