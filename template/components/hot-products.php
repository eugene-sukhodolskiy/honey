<?
	$hot_products = array_map(function($post){
		return wc_get_product($post -> ID);
	}, get_field('hot_products', isset($post) ? $post -> ID : get_the_ID()));
?>

<?= $this -> join('components/swipeable-product-line', [
	'title' => get_field('block_title', isset($post) ? $post -> ID : get_the_ID()),
	'additional_css_class' => 'recommended-products',
	'products' => $hot_products
]) ?>