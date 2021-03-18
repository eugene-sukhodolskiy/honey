<div class="swipeable-product-line <?= $additional_css_class ?>">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="block-title"><?= $title ?></h1>
			</div> 
		</div> 
	</div>		

	<div class="container products-carousel-container"> 
		<div class="products-carousel">
			<? foreach($products as $i => $product): ?>
				<?= $this -> join('components/cards/product', [
					'product' => $product
				]) ?>
			<? endforeach ?>
		</div>
	</div>
</div>

<script> 
	$(document).ready(function(){
		$('.<?= $additional_css_class ?> .products-carousel').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: false,
			arrows: false,
			dots: false,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		});
	});	
</script>