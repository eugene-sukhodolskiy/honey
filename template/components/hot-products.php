<?
	$hot_products = array_map(function($post){
		return wc_get_product($post -> ID);
	}, get_field('hot_products'));
?>

<?= $this -> join('components/swipeable-product-line', [
	'title' => get_field('block_title'),
	'additional_css_class' => 'best-products',
	'products' => $hot_products
]) ?>