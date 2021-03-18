<? $this -> extends_from('base-page') ?>

<?
	$w = new \ThemeCore\Classes\Weights($products);
	$selected_weight = isset($_GET['weight']) ? $_GET['weight'] : -1;
	$weights = array_map(function($item) use($selected_weight){
		return [
			'val' => $item,
			'selected' => $selected_weight == $item ? true : false,
			'url' => '?weight=' . $item
		];
	}, $w -> get_diversity());

	usort($weights, function($item1, $item2){
		return $item1 < $item2;
	});

	if($selected_weight < 0){
		$weights[0]['selected'] = true;
		$selected_weight = $weights[0]['val'];
	}
?>

<div class="page-wrap products-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<h3 class="page-title"><?= $cat -> post_title ?></h3>
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<?= $this -> join('components/weight-selector', [
					'weights' => $weights
				]) ?>
			</div> 

			<?php foreach ($products as $i => $product): ?>
				<? if($selected_weight > 0 and $product -> get_weight() != $selected_weight) continue; ?>
				<div class="col-6 col-lg-4 col-xl-3 product-line-item">
					<?= $this -> join('components/cards/product', [
						'product' => $product
					]) ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>