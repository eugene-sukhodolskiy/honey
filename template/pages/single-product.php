<? $this -> extends_from('base-page') ?>

<?
	$regular_price = $product -> get_regular_price();
	$sale_price = $product -> get_sale_price();
	$percent = $sale_price ? round(100 - $sale_price / $regular_price * 100) : 0;
	$currency = str_replace('UAH', 'грн', get_woocommerce_currency());
	$with_weight = get_field('with_weight');

	if($with_weight or is_null($with_weight)){
		$weight = $product -> get_weight() * 1000;

		// alt weights
		$alt_weights = get_field('alt_weights');
		$weights = [
			[
				'val' => floatval($product -> get_weight()), 
				'url' => $product -> get_permalink(),
				'selected' => true
			]
		];

		if(is_array($alt_weights)){
			foreach($alt_weights as $p){
				$p = wc_get_product($p -> ID);
				$weights[] = [
					'val' => floatval($p -> get_weight()), 
					'url' => $p -> get_permalink()
				];
			}

			usort($weights, function($item1, $item2){
				return $item1['val'] < $item2['val'];
			});
		}
	}

	$composition = get_field('composition');
	$prod_label = get_post_meta($product -> get_id(), 'prod_label');

?>

<div class="page-wrap single-product-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5 col-xl-5">
				<div class="product-img-container">
					<? if($percent > 0): ?>
						<div class="bubl">-<?= $percent ?>%</div>
					<? endif ?>
					<? if(is_array($prod_label) and count($prod_label) and strlen($prod_label[0])): ?>
						<div class="product-label">
							<?= $prod_label[0] ?>
						</div>
					<? endif ?>
					<?= str_replace('class="', 'class="product-img ', $product -> get_image('full')) ?>

				</div>
			</div>
			<div class="col-12 col-lg-7 col-xl-7">
				<div class="about-product">
					<h1 class="title"><?= $product -> get_name() ?></h1>
					<div class="description">
						<?= $product -> get_description() ?>
					</div>

					<? if($with_weight or is_null($with_weight)): ?>
						<div class="weight-container">
							<?= $this -> join('components/weight-selector', [
								'weights' => $weights
							]) ?>
						</div>
					<? endif ?>

					<? if($composition and strlen($composition)): ?>
						<div class="composition">
							<h3 class="heading">Склад:</h3>
							<?= $composition ?>
						</div>
					<? endif ?>

				</div>
				<div class="row price-and-buy-container">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="price">
							<span class="value">
								<?= $sale_price ? $sale_price : $regular_price; ?>
							</span>
							<? if($sale_price): ?>
								<span class="old-value">
									<?= $regular_price ?>
								</span>
							<? endif ?>
							<span class="unit"><?= $currency ?></span>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="buy">
							<?= $this -> join('components/buy-btn', [
								'product_id' => $product -> get_id(),
								'btntext' => 'Купити',
								'addition_class' => 'lg',
								'quantity' => 1
							]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<div class="container">
		<?= $this -> join('components/buy-together', [
			'current_product' => $product
		]) ?>
	</div>
</div>