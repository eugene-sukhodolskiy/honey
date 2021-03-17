<?
	$regular_price = $product -> get_regular_price();
	$sale_price = $product -> get_sale_price();
	$percent = $sale_price ? round(100 - $sale_price / $regular_price * 100) : 0;
	$weight = $product -> get_weight() * 1000;
	list($is_new_prod) = get_post_meta($product -> get_id(), 'it_new_prod');
	$currency = str_replace('UAH', 'грн', get_woocommerce_currency());
?>

<div class="product-card">
	<div class="product-head">
		<? if($percent): ?>
			<div class="bubl">-<?= $percent ?>%</div>
		<? endif ?>

		<? if($is_new_prod): ?>
			<div class="product-label">
				Новинка
			</div>
		<? endif ?>

		<div class="product-thumb">
			<a href="<?= $product -> get_permalink() ?>" class="no-style">
				<?= str_replace('class="', 'class="product-pic ', $product -> get_image('medium')) ?>
			</a>
		</div>
	</div>
	<div class="product-body">
		<h3 class="product-title">
			<a href="<?= $product -> get_permalink() ?>" class="no-style">
				<?= $product -> get_name() ?>
			</a>
		</h3>
		
		<div class="product-price">
			<span class="current">
				<span class="val"><?= $sale_price ? $sale_price : $regular_price; ?></span>
				<span class="currency"><?= $currency ?></span>
			</span>
			<? if($sale_price): ?>
				<span class="old">
					<span class="val"><?= $regular_price ?></span>
					<span class="currency"><?= $currency ?></span>
				</span>
			<? endif ?>

			<span class="sep">/</span>

			<span class="weight">
				<span class="val"><?= $weight ?></span>
				<span class="unit">г</span>
			</span>
		</div>
		<div class="btns">
			<?= $this -> join('components/buy-btn', [
				'product_id' => $product -> get_id(),
				'btntext' => 'Купить',
			]) ?>
		</div>
	</div>
</div>