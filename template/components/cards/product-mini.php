<?
	$with_weight = !isset($with_weight) ? true : $with_weight;
	$regular_price = $product -> get_regular_price();
	$sale_price = $product -> get_sale_price();
	$percent = $sale_price ? round(100 - $sale_price / $regular_price * 100) : 0;
	
	if($with_weight){
		$weight = $product -> get_weight() * 1000;
	}

	$prod_label = get_post_meta($product -> get_id(), 'prod_label');
	$currency = str_replace('UAH', 'грн', get_woocommerce_currency());
	$quantity = isset($quantity) ? $quantity : 1;
?>

<div class="product-card mini" data-item-key="<?= $item_key ?>">
	<div class="product-head">
		<? if($percent): ?>
			<div class="bubl">-<?= $percent ?>%</div>
		<? endif ?>

		<? if(is_array($prod_label) and count($prod_label) and strlen($prod_label[0])): ?>
			<div class="product-label">
				<?= $prod_label[0] ?>
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
				<span class="val">
					<?= $sale_price ? $sale_price : $regular_price; ?>
				</span>
				<span class="currency"><?= $currency ?></span>
			</span>
			<? if($sale_price): ?>
				<span class="old">
					<span class="val"><?= $regular_price ?></span>
					<span class="currency"><?= $currency ?></span>
				</span>
			<? endif ?>

			<? if($with_weight and isset($weight)): ?>
				<span class="sep">/</span>

				<span class="weight">
					<span class="val"><?= $weight ?></span>
					<span class="unit">г</span>
				</span>
			<? endif ?>
		</div>
		<div class="btns">
			<?= $this -> join('components/buy-btn', [
				'product_id' => $product -> get_id(),
				'btntext' => '',
				'addition_class' => 'sm',
				'quantity' => $quantity,
				'no_click' => true
			]) ?>
			<button class="button-cancel" data-item-key="<?= $item_key ?>">
				<ion-icon name="close-circle-outline"></ion-icon>
			</button>
		</div>
	</div>
</div>