<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?= $this->assetUrl('img/favicon.ico') ?>">

	<title><?= $this->e($title) ?></title>


	<link href="<?= $this->assetUrl('css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= $this->assetUrl('css/ie10-viewport-bug-workaround.css') ?>" rel="stylesheet">
	<link href="<?= $this->assetUrl('css/dashboard.css') ?>" rel="stylesheet">

	<script src="<?= $this->assetUrl('js/ie-emulation-modes-warning.js') ?>"></script>
	<!--[if lt IE 9]>
	<script src="<?= $this->assetUrl('js/html5shiv.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/respond.min.js') ?>"></script>
	<![endif]-->
</head>

<body>

	<?= $this->fetch('admin/partials/navbar') ?>

	<div class="container-fluid">
		<div class="row">
			<?= $this->fetch('admin/partials/sidebar') ?>

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<?= $this->section('main_content') ?>
			</div>
		</div>
	</div>

	<script src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/holder.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/ie10-viewport-bug-workaround.js') ?>"></script>
</body>
</html>
