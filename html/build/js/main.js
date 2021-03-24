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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCl7XG5cdGJ1eUNvbnRyb2xJbml0KCk7XG5cdG1vYk1lbnVJbml0KCk7XG5cdGFkZFRvQ2FydEJ0bnNJbml0KCk7XG5cdHJlbW92ZUZyb21DYXJ0QnRuSW5pdCgpO1xufSk7XG5cbmZ1bmN0aW9uIG1vYk1lbnVJbml0KCl7XG5cdCQoJy5oZWFkZXIgLm1lbnUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuXHRcdGNvbnN0IGhlYWRlciA9ICQoJy5oZWFkZXInKTtcblx0XHRjb25zdCBtZW51QnRuID0gJCh0aGlzKTtcblxuXHRcdGlmKCFoZWFkZXIuaGFzQ2xhc3MoJ21vYicpKXtcblx0XHRcdGhlYWRlci5hZGRDbGFzcygnbW9iJyk7XG5cdFx0XHRtZW51QnRuLmF0dHIoJ2RhdGEtc3RhdGUnLCAnb3BlbicpO1xuXHRcdH1lbHNle1xuXHRcdFx0aGVhZGVyLnJlbW92ZUNsYXNzKCdtb2InKTtcblx0XHRcdG1lbnVCdG4uYXR0cignZGF0YS1zdGF0ZScsICdjbG9zZScpO1xuXHRcdH1cblx0fSk7XG59XG5cbmZ1bmN0aW9uIGJ1eUJ0bkNsaWNrRml4KGJ0bil7XG5cdGNvbnN0IGJ1eUNvbnRyb2wgPSAkKGJ0bikuZmluZCgnLmJ1eS1jb250cm9sJyk7XG5cdGlmKGJ1eUNvbnRyb2wgIT0gJ3VuZGVmaW5lZCcgJiYgYnV5Q29udHJvbC5hdHRyKCdkYXRhLWl0LWNsaWNrJykgPT0gJ3RydWUnKXtcblx0XHRidXlDb250cm9sLnJlbW92ZUF0dHIoJ2RhdGEtaXQtY2xpY2snKTtcblx0XHRyZXR1cm4gdHJ1ZTtcblx0fVxuXHRyZXR1cm4gZmFsc2U7XG59XG5cbmZ1bmN0aW9uIGJ1eUNvbnRyb2xJbml0KCl7XG5cdGNvbnN0IGJ0bnMgPSAkKCcuYnV5LWNvbnRyb2wgLmNvbnRyb2wtbWludXMsIC5idXktY29udHJvbCAuY29udHJvbC1wbHVzJyk7XG5cdGJ0bnMub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcblx0XHRjb25zdCBzZWxmID0gJCh0aGlzKTtcblx0XHRjb25zdCB0aGlzU3RydWN0ID0gc2VsZi5wYXJlbnQoKTtcblx0XHRjb25zdCB2YWx1ZUNvbnRhaW5lciA9IHRoaXNTdHJ1Y3QuZmluZCgnLmJ1eS12YWx1ZScpO1xuXG5cdFx0dGhpc1N0cnVjdC5hdHRyKCdkYXRhLWl0LWNsaWNrJywgJ3RydWUnKTtcblxuXHRcdGxldCBtaW4gPSAxO1xuXHRcdGxldCBtYXggPSB0aGlzU3RydWN0LmF0dHIoJ2RhdGEtbWF4Jyk7XG5cdFx0bGV0IHZhbHVlID0gdGhpc1N0cnVjdC5hdHRyKCdkYXRhLXZhbHVlJyk7XG5cdFx0bWF4ID0gKHR5cGVvZiBtYXggPT0gJ3VuZGVmaW5lZCcpID8gMTAwMCA6IG1heDtcblx0XHR2YWx1ZSA9ICh0eXBlb2YgdmFsdWUgPT0gJ3VuZGVmaW5lZCcpID8gMCA6IHZhbHVlO1xuXG5cdFx0aWYoc2VsZi5oYXNDbGFzcygnY29udHJvbC1taW51cycpKXtcblx0XHRcdHZhbHVlLS07XG5cdFx0fWVsc2UgaWYoc2VsZi5oYXNDbGFzcygnY29udHJvbC1wbHVzJykpe1xuXHRcdFx0dmFsdWUrKztcblx0XHR9XG5cblx0XHRpZih2YWx1ZSA8IG1pbiB8fCB2YWx1ZSA+IG1heCl7XG5cdFx0XHRyZXR1cm47XG5cdFx0fVxuXG5cdFx0dGhpc1N0cnVjdC5hdHRyKCdkYXRhLXZhbHVlJywgdmFsdWUpO1xuXHRcdHZhbHVlQ29udGFpbmVyLmh0bWwodmFsdWUpO1xuXHR9KTtcblxuXHQkKCcub3JkZXItZm9ybS1wYWdlJykuZmluZCgnLmJ1eS1jb250cm9sIC5jb250cm9sLW1pbnVzLCAuYnV5LWNvbnRyb2wgLmNvbnRyb2wtcGx1cycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG5cdFx0Y29uc3QgYnV5QnRuID0gJCh0aGlzKS5wYXJlbnQoKS5wYXJlbnQoKTtcblx0XHRuZXdJdGVtUXVhbnRpdHlDYXJ0KGJ1eUJ0bik7XG5cdH0pO1xufVxuXG5mdW5jdGlvbiBhZGRUb0NhcnRCdG5zSW5pdCgpe1xuXHRjb25zdCBidG5zID0gJCgnYnV0dG9uLmJ1eScpO1xuXG5cdGJ0bnMuZWFjaChmdW5jdGlvbigpe1xuXHRcdGNvbnN0IGJ0biA9ICQodGhpcyk7XG5cblx0XHRpZihidG4uYXR0cignZGF0YS1pbml0LWZsYWcnKSAhPSAnYWxyZWFkeSBpbml0Jyl7XG5cdFx0XHRidG4ub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG5cdFx0XHRcdGNvbnN0IG5vQ2xpY2tGbGFnID0gKHR5cGVvZiBidG4uYXR0cignZGF0YS1uby1jbGljaycpID09ICd1bmRlZmluZWQnKSA/IGZhbHNlIDogdHJ1ZTtcblx0XHRcdFx0XG5cdFx0XHRcdGlmKGJ1eUJ0bkNsaWNrRml4KHRoaXMpIHx8IG5vQ2xpY2tGbGFnKXtcblx0XHRcdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7IFxuXHRcdFx0XHRcdHJldHVybiBmYWxzZTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdGFkZFRvQ2FydChidG4pO1xuXG5cdFx0XHR9KTtcblxuXHRcdFx0YnRuLmF0dHIoJ2RhdGEtaW5pdC1mbGFnJywgJ2FscmVhZHkgaW5pdCcpO1xuXHRcdH1cblx0fSlcbn1cblxuZnVuY3Rpb24gYWRkVG9DYXJ0KGJ0bil7XG5cdGNvbnN0IHF1YW50aXR5Q29udHJvbCA9ICQoYnRuKS5maW5kKCcuYnV5LWNvbnRyb2wnLCAwKTtcblx0Y29uc3QgZGF0YSA9IHtcblx0XHQncHJvZHVjdF9pZCc6ICQoYnRuKS5hdHRyKCdkYXRhLXByb2R1Y3QtaWQnKSxcblx0XHQncXVhbnRpdHknOiAkKHF1YW50aXR5Q29udHJvbCkuYXR0cignZGF0YS12YWx1ZScpLFxuXHRcdCdhY3Rpb24nOiAnd29vY29tbWVyY2VfYWpheF9hZGRfdG9fY2FydCdcblx0fTtcblxuXHQkLmFqYXgoe1xuXHRcdHVybDogJy93cC1hZG1pbi9hZG1pbi1hamF4LnBocCcsXG5cdFx0ZGF0YTogZGF0YSxcblx0XHRtZXRob2Q6ICdwb3N0J1xuXHR9KS5kb25lKGZ1bmN0aW9uKHJlc3BvbnNlKXtcblx0XHRjb25zb2xlLmxvZyhyZXNwb25zZSk7XG5cdFx0cmVmcmVzaENhcnRDb3VudGVyKCk7XG5cdFx0YnRuLmF0dHIoJ2RhdGEtbm8tY2xpY2snLCAndHJ1ZScpO1xuXHRcdGJ0bi5odG1sKCfQoyDQutC+0YjQuNC60YMnKTtcblx0fSk7XG59XG5cbmZ1bmN0aW9uIG5ld0l0ZW1RdWFudGl0eUNhcnQoYnRuKXtcblx0Y29uc3QgcXVhbnRpdHlDb250cm9sID0gJChidG4pLmZpbmQoJy5idXktY29udHJvbCcsIDApO1xuXHRjb25zdCBwcm9kdWN0Q2FyZCA9ICQoYnRuKS5wYXJlbnQoKS5wYXJlbnQoKS5wYXJlbnQoKTtcblx0Y29uc3QgZGF0YSA9IHtcblx0XHQnaXRlbV9rZXknOiBwcm9kdWN0Q2FyZC5hdHRyKCdkYXRhLWl0ZW0ta2V5JyksXG5cdFx0J3F1YW50aXR5JzogJChxdWFudGl0eUNvbnRyb2wpLmF0dHIoJ2RhdGEtdmFsdWUnKSxcblx0XHQnYWN0aW9uJzogJ3dvb2NvbW1lcmNlX2FqYXhfbmV3X3RlbV9xdWFudGl0eV9jYXJ0J1xuXHR9O1xuXG5cdGNvbnNvbGUubG9nKGRhdGEpO1xuXG5cdCQuYWpheCh7XG5cdFx0dXJsOiAnL3dwLWFkbWluL2FkbWluLWFqYXgucGhwJyxcblx0XHRkYXRhOiBkYXRhLFxuXHRcdG1ldGhvZDogJ3Bvc3QnXG5cdH0pLmRvbmUoZnVuY3Rpb24ocmVzcG9uc2Upe1xuXHRcdGNvbnNvbGUubG9nKHJlc3BvbnNlKTtcblx0XHRyZWZyZXNoQ2FydENvdW50ZXIoKTtcblx0fSk7XG59XG5cbmZ1bmN0aW9uIHJlbW92ZUZyb21DYXJ0QnRuSW5pdCgpe1xuXHRjb25zdCBidG5zID0gJCgnW2RhdGEtaXRlbS1rZXldJyk7XG5cblx0YnRucy5lYWNoKGZ1bmN0aW9uKCl7XG5cdFx0Y29uc3QgYnRuID0gJCh0aGlzKTtcblxuXHRcdGlmKGJ0bi5hdHRyKCdkYXRhLWluaXQtZmxhZycpICE9ICdhbHJlYWR5IGluaXQnKXtcblx0XHRcdGJ0bi5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuXHRcdFx0XHRjb25zdCBpdGVtS2V5ID0gYnRuLmF0dHIoJ2RhdGEtaXRlbS1rZXknKTtcblx0XHRcdFx0Y29uc3QgZGF0YSA9IHtcblx0XHRcdFx0XHQnaXRlbV9rZXknOiBpdGVtS2V5LFxuXHRcdFx0XHRcdCdhY3Rpb24nOiAnd29vY29tbWVyY2VfYWpheF9yZW1vdmVfZnJvbV9jYXJ0J1xuXHRcdFx0XHR9O1xuXG5cdFx0XHRcdCQuYWpheCh7XG5cdFx0XHRcdFx0dXJsOiAnL3dwLWFkbWluL2FkbWluLWFqYXgucGhwJyxcblx0XHRcdFx0XHRkYXRhOiBkYXRhLFxuXHRcdFx0XHRcdG1ldGhvZDogJ3Bvc3QnXG5cdFx0XHRcdH0pLmRvbmUoZnVuY3Rpb24ocmVzcG9uc2Upe1xuXHRcdFx0XHRcdGNvbnNvbGUubG9nKHJlc3BvbnNlKTtcblx0XHRcdFx0XHRyZWZyZXNoQ2FydENvdW50ZXIoKTtcblx0XHRcdFx0fSk7XG5cdFx0XHR9KTtcblx0XHRcdGJ0bi5hdHRyKCdkYXRhLWluaXQtZmxhZycsICdhbHJlYWR5IGluaXQnKTtcblx0XHR9XG5cdH0pO1xufVxuXG5mdW5jdGlvbiByZWZyZXNoQ2FydENvdW50ZXIoKXtcblx0Y29uc3QgY291bnRlckNvbnRhaW5lciA9ICQoJy5iYXNrZXQtYnV0dG9uIC5jb3VudGVyJyk7XG5cblx0Y29uc3QgZGF0YSA9IHtcblx0XHQnYWN0aW9uJzogJ3dvb2NvbW1lcmNlX2FqYXhfZ2V0X2NhcnRfY291bnRlcidcblx0fTtcblxuXHQkLmFqYXgoe1xuXHRcdHVybDogJy93cC1hZG1pbi9hZG1pbi1hamF4LnBocCcsXG5cdFx0ZGF0YTogZGF0YSxcblx0XHRtZXRob2Q6ICdwb3N0J1xuXHR9KS5kb25lKGZ1bmN0aW9uKHJlc3BKU09OKXtcblx0XHRyZXNwID0gSlNPTi5wYXJzZShyZXNwSlNPTik7XG5cdFx0Y291bnRlckNvbnRhaW5lci5odG1sKHJlc3AuY291bnRlcik7XG5cdH0pO1xufSJdLCJmaWxlIjoibWFpbi5qcyJ9
