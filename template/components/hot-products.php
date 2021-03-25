<?
	$hot_products = array_map(function($post){
		return wc_get_product($post -> ID);
	}, get_field('hot_products', $post -> ID));
?>

<?= $this -> join('components/swipeable-product-line', [
	'title' => get_field('block_title', $post -> ID),
	'additional_css_class' => 'recommended-products',
	'products' => $hot_products
]) ?>