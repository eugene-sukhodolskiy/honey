<button 
	class="button <?= isset($addition_class) ? $addition_class : '' ?> buy"
	data-product-id="<?= $product_id ?>"
	<? if(isset($no_click) and $no_click): ?> data-no-click="true" <? endif ?>
>
	<?= $btntext ?>
	<span class="buy-control" data-value="<?= $quantity ?>" data-max="10">
		<span class="control-minus">
			<ion-icon name="chevron-back-outline"></ion-icon>
		</span>
		<span class="buy-value"><?= $quantity ?></span>
		<span class="control-plus">
			<ion-icon name="chevron-forward-outline"></ion-icon>
		</span>
	</span>
</button>