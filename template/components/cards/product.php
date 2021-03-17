<?
	$regular_price = $product -> get_regular_price();
	$sale_price = $product -> get_sale_price();
	$percent = $sale_price ? 100 - $sale_price / $regular_price * 100 : 0;
	$weight = $product -> get_weight() * 1000;
	list($first_tag) = explode(',', wc_get_product_tag_list($product -> get_id(), ','));

	list($is_new_prod) = get_post_meta($product -> get_id(), 'it_new_prod');
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
				<span class="currency">грн</span>
			</span>
			<? if($sale_price): ?>
				<span class="old">
					<span class="val"><?= $regular_price ?></span>
					<span class="currency">грн</span>
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
				'btntext' => 'Купить',
			]) ?>
		</div>
	</div>
</div>