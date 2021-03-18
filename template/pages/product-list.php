<? $this -> extends_from('base-page') ?>

<div class="page-wrap products-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<h3 class="page-title"><?= $cat -> post_title ?></h3>
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<?= $this -> join('components/weight-selector', [
					'weights' => [
						['val' => 0.5, 'selected' => true],
						['val' => 0.2],
						['val' => 0.1]
					]
				]) ?>
			</div> 

			<?php foreach ($products as $i => $product): ?>
				<div class="col-6 col-lg-4 col-xl-3 product-line-item">
					<?= $this -> join('components/cards/product', [
						'product' => $product
					]) ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>