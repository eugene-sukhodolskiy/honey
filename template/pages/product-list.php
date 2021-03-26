<? $this -> extends_from('base-page') ?>

<div class="page-wrap products-page">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="page-title"><?= $cat -> post_title ?></h3>
			</div>

			<?php foreach ($products as $i => $product): ?>
				<div class="col-6 col-lg-4 col-xl-3 product-line-item">
					<?= $this -> join('components/cards/product', [
						'product' => $product,
						'with_weight' => false
					]) ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>