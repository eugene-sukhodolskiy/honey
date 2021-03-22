<?
	// Buy together
	$buy_together_products = @array_map(function($post){
		return wc_get_product($post -> ID);
	}, get_field('buy_together'));
?>

<? if(is_array($buy_together_products)): ?>
	<?= $this -> join('components/swipeable-product-line', [
		'title' => 'Разом з цим купують',
		'additional_css_class' => 'recommended-products',
		'products' => is_array($buy_together_products) ? $buy_together_products : []
	]) ?>
<? endif ?>