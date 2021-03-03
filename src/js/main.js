$(document).ready(function(){
	console.log("init app!"); 

	buyControlInit();
	mobMenuInit();
	
	$('.buy').on('click', function(e){
		if(buyBtnClickFix(this)){
			e.preventDefault();
			return false;
		}

		console.log('buy');
	});
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
	$('.buy-control .control-minus, .buy-control .control-plus').on('click', function(){
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
}