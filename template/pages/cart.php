<? $this -> extends_from('base-page') ?>

<div class="page-wrap order-form-page">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="page-title"><?= $post -> post_title ?> </h3>
			</div>
			<div class="col-12 col-lg-6 col-xl-7 order-2 order-lg-1 order-xl-1">
				<div class="form-container">
					<?= $this -> join('components/checkout') ?>
				</div>
			</div>

			<div class="col-12 col-lg-6 col-xl-5 order-1 order-lg-2 order-xl-2">
				<div class="product-list-container">
					<h3>Ваше замовлення (<strong class="counter">1</strong>)</h3>
					<ul class="product-list">
						<? foreach($products_sets as $item_key => $p_set): ?>
							<li>
								<?= $this -> join('components/cards/product-mini', [
									'product' => $p_set['product'],
									'quantity' => $p_set['product_cart']['quantity'],
									'item_key' => $item_key,
									'with_weight' => get_field('with_weight', $p_set['product'] -> get_id())
								]) ?>
							</li>	
						<? endforeach ?>
					</ul>
				</div>

				<script>
					function calculate_count(){
						const products = $('.product-list .product-card');
						const counterContainer = $('.product-list-container .counter');
						const totalPriceContainer = $('.total-price .value');
						let count = 0;
						let totalPrice = 0;

						for(let product of products){
							let prod = $(product);
							let c = parseInt(prod.find('.buy-control').attr('data-value'));
							count += c;
							totalPrice += parseInt(prod.find('.product-price .current .val').html()) * c;
						}

						counterContainer.html(count);
						totalPriceContainer.html(totalPrice);
					}

					$(document).ready(function(){
						calculate_count();
						const btnsPlusMinus = $('.product-list .product-card .buy-control').find('.control-minus, .control-plus');

						btnsPlusMinus.on('click', function(){
							setTimeout(function(){
								calculate_count();
							}, 50);
						});

						$('.product-list .product-card .button-cancel').on('click', function(){
							$(this).parent().parent().parent().parent().remove();
							calculate_count();
						});
					});
				</script>

			</div>
		</div>
	</div>

	<?= $this -> join('components/hot-products', ['post' => $post]) ?>
	<script>
		$(document).ready(function(){
			$('.recommended-products .buy').on('click', function(){
				
			});
		});
	</script>
</div>