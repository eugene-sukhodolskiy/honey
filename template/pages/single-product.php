<? $this -> extends_from('base-page') ?>

<?
	$regular_price = $product -> get_regular_price();
	$sale_price = $product -> get_sale_price();
	$percent = $sale_price ? round(100 - $sale_price / $regular_price * 100) : 0;
	$weight = $product -> get_weight() * 1000;
	$currency = str_replace('UAH', 'грн', get_woocommerce_currency());


	// alt weights
	$alt_weights = get_field('alt_weights');
	$weights = [
		[
			'val' => floatval($product -> get_weight()), 
			'url' => $product -> get_permalink(),
			'selected' => true
		]
	];

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

?>

<div class="page-wrap single-product-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5 col-xl-5">
				<div class="product-img-container">
					<?= str_replace('class="', 'class="product-img ', $product -> get_image('medium')) ?>
				</div>
			</div>
			<div class="col-12 col-lg-7 col-xl-7">
				<div class="about-product">
					<h1 class="title"><?= $product -> get_name() ?></h1>
					<div class="description">
						<?= $product -> get_description() ?>
					</div>
					<div class="weight-container">
						<?= $this -> join('components/weight-selector', [
							'weights' => $weights
						]) ?>
					</div>
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
								'btntext' => 'Купить',
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