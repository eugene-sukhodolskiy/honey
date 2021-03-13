<? $this -> extends_from('base-template') ?>
<? extract($this -> get_inside_data()) ?>

<?= $this -> join('layouts/header') ?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-8">
				<?= $this -> content() ?>
			</div>
			<div class="col-12 col-lg-4 col-xl-4">
				<?= $this -> join('layouts/sidebar') ?>
			</div>
		</div>
	</div>
<?= $this -> join('layouts/footer') ?>