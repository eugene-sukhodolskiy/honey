$(document).ready(function(){
	buyControlInit();
	mobMenuInit();
	addToCartBtnsInit();
	removeFromCartBtnInit();
});

function mobMenuInit(){
	$('.header .menu').on('click', function(){
		const header = $('.header');
		const menuBtn = $(this);

		if(!header.hasClass('mob')){
			header.addClass('mob');
			menuBtn.attr('data-state', 'open');
		}else{
			header.removeClass('mob');
			menuBtn.attr('data-state', 'close');
		}
	});
}

function buyBtnClickFix(btn){
	const buyControl = $(btn).find('.buy-control');
	if(buyControl != 'undefined' && buyControl.attr('data-it-click') == 'true'){
		buyControl.removeAttr('data-it-click');
		return true;
	}
	return false;
}

function buyControlInit(){
	const btns = $('.buy-control .control-minus, .buy-control .control-plus');
	btns.on('click', function(){
		const self = $(this);
		const thisStruct = self.parent();
		const valueContainer = thisStruct.find('.buy-value');

		thisStruct.attr('data-it-click', 'true');

		let min = 1;
		let max = thisStruct.attr('data-max');
		let value = thisStruct.attr('data-value');
		max = (typeof max == 'undefined') ? 1000 : max;
		value = (typeof value == 'undefined') ? 0 : value;

		if(self.hasClass('control-minus')){
			value--;
		}else if(self.hasClass('control-plus')){
			value++;
		}

		if(value < min || value > max){
			return;
		}

		thisStruct.attr('data-value', value);
		valueContainer.html(value);
	});

	$('.order-form-page').find('.buy-control .control-minus, .buy-control .control-plus').on('click', function(){
		const buyBtn = $(this).parent().parent();
		newItemQuantityCart(buyBtn);
	});
}

function addToCartBtnsInit(){
	const btns = $('button.buy');

	btns.each(function(){
		const btn = $(this);

		if(btn.attr('data-init-flag') != 'already init'){
			btn.on('click', function(e){
				const noClickFlag = (typeof btn.attr('data-no-click') == 'undefined') ? false : true;
				
				if(buyBtnClickFix(this) || noClickFlag){
					e.preventDefault(); 
					return false;
				}

				addToCart(btn);

			});

			btn.attr('data-init-flag', 'already init');
		}
	})
}

function addToCart(btn){
	const quantityControl = $(btn).find('.buy-control', 0);
	const data = {
		'product_id': $(btn).attr('data-product-id'),
		'quantity': $(quantityControl).attr('data-value'),
		'action': 'woocommerce_ajax_add_to_cart'
	};

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		data: data,
		method: 'post'
	}).done(function(response){
		console.log(response);
		refreshCartCounter();
		btn.attr('data-no-click', 'true');
		btn.html('У кошику');
	});
}

function newItemQuantityCart(btn){
	const quantityControl = $(btn).find('.buy-control', 0);
	const productCard = $(btn).parent().parent().parent();
	const data = {
		'item_key': productCard.attr('data-item-key'),
		'quantity': $(quantityControl).attr('data-value'),
		'action': 'woocommerce_ajax_new_tem_quantity_cart'
	};

	console.log(data);

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		data: data,
		method: 'post'
	}).done(function(response){
		console.log(response);
		refreshCartCounter();
	});
}

function removeFromCartBtnInit(){
	const btns = $('[data-item-key]');

	btns.each(function(){
		const btn = $(this);

		if(btn.attr('data-init-flag') != 'already init'){
			btn.on('click', function(){
				const itemKey = btn.attr('data-item-key');
				const data = {
					'item_key': itemKey,
					'action': 'woocommerce_ajax_remove_from_cart'
				};

				$.ajax({
					url: '/wp-admin/admin-ajax.php',
					data: data,
					method: 'post'
				}).done(function(response){
					console.log(response);
					refreshCartCounter();
				});
			});
			btn.attr('data-init-flag', 'already init');
		}
	});
}

function refreshCartCounter(){
	const counterContainer = $('.basket-button .counter');

	const data = {
		'action': 'woocommerce_ajax_get_cart_counter'
	};

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		data: data,
		method: 'post'
	}).done(function(respJSON){
		resp = JSON.parse(respJSON);
		counterContainer.html(resp.counter);
	});
}