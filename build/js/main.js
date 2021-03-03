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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCl7XG5cdGNvbnNvbGUubG9nKFwiaW5pdCBhcHAhXCIpOyBcblxuXHRidXlDb250cm9sSW5pdCgpO1xuXHRtb2JNZW51SW5pdCgpO1xuXHRcblx0JCgnLmJ1eScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xuXHRcdGlmKGJ1eUJ0bkNsaWNrRml4KHRoaXMpKXtcblx0XHRcdGUucHJldmVudERlZmF1bHQoKTtcblx0XHRcdHJldHVybiBmYWxzZTtcblx0XHR9XG5cblx0XHRjb25zb2xlLmxvZygnYnV5Jyk7XG5cdH0pO1xufSk7XG5cbmZ1bmN0aW9uIG1vYk1lbnVJbml0KCl7XG5cdCQoJy5oZWFkZXIgLm1lbnUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuXHRcdGNvbnN0IGhlYWRlciA9ICQoJy5oZWFkZXInKTtcblx0XHRjb25zdCBtZW51QnRuID0gJCh0aGlzKTtcblxuXHRcdGlmKCFoZWFkZXIuaGFzQ2xhc3MoJ21vYicpKXtcblx0XHRcdGhlYWRlci5hZGRDbGFzcygnbW9iJyk7XG5cdFx0XHRtZW51QnRuLmF0dHIoJ2RhdGEtc3RhdGUnLCAnb3BlbicpO1xuXHRcdH1lbHNle1xuXHRcdFx0aGVhZGVyLnJlbW92ZUNsYXNzKCdtb2InKTtcblx0XHRcdG1lbnVCdG4uYXR0cignZGF0YS1zdGF0ZScsICdjbG9zZScpO1xuXHRcdH1cblx0fSk7XG59XG5cbmZ1bmN0aW9uIGJ1eUJ0bkNsaWNrRml4KGJ0bil7XG5cdGNvbnN0IGJ1eUNvbnRyb2wgPSAkKGJ0bikuZmluZCgnLmJ1eS1jb250cm9sJyk7XG5cdGlmKGJ1eUNvbnRyb2wgIT0gJ3VuZGVmaW5lZCcgJiYgYnV5Q29udHJvbC5hdHRyKCdkYXRhLWl0LWNsaWNrJykgPT0gJ3RydWUnKXtcblx0XHRidXlDb250cm9sLnJlbW92ZUF0dHIoJ2RhdGEtaXQtY2xpY2snKTtcblx0XHRyZXR1cm4gdHJ1ZTtcblx0fVxuXHRyZXR1cm4gZmFsc2U7XG59XG5cbmZ1bmN0aW9uIGJ1eUNvbnRyb2xJbml0KCl7XG5cdCQoJy5idXktY29udHJvbCAuY29udHJvbC1taW51cywgLmJ1eS1jb250cm9sIC5jb250cm9sLXBsdXMnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuXHRcdGNvbnN0IHNlbGYgPSAkKHRoaXMpO1xuXHRcdGNvbnN0IHRoaXNTdHJ1Y3QgPSBzZWxmLnBhcmVudCgpO1xuXHRcdGNvbnN0IHZhbHVlQ29udGFpbmVyID0gdGhpc1N0cnVjdC5maW5kKCcuYnV5LXZhbHVlJyk7XG5cblx0XHR0aGlzU3RydWN0LmF0dHIoJ2RhdGEtaXQtY2xpY2snLCAndHJ1ZScpO1xuXG5cdFx0bGV0IG1pbiA9IDE7XG5cdFx0bGV0IG1heCA9IHRoaXNTdHJ1Y3QuYXR0cignZGF0YS1tYXgnKTtcblx0XHRsZXQgdmFsdWUgPSB0aGlzU3RydWN0LmF0dHIoJ2RhdGEtdmFsdWUnKTtcblx0XHRtYXggPSAodHlwZW9mIG1heCA9PSAndW5kZWZpbmVkJykgPyAxMDAwIDogbWF4O1xuXHRcdHZhbHVlID0gKHR5cGVvZiB2YWx1ZSA9PSAndW5kZWZpbmVkJykgPyAwIDogdmFsdWU7XG5cblx0XHRpZihzZWxmLmhhc0NsYXNzKCdjb250cm9sLW1pbnVzJykpe1xuXHRcdFx0dmFsdWUtLTtcblx0XHR9ZWxzZSBpZihzZWxmLmhhc0NsYXNzKCdjb250cm9sLXBsdXMnKSl7XG5cdFx0XHR2YWx1ZSsrO1xuXHRcdH1cblxuXHRcdGlmKHZhbHVlIDwgbWluIHx8IHZhbHVlID4gbWF4KXtcblx0XHRcdHJldHVybjtcblx0XHR9XG5cblx0XHR0aGlzU3RydWN0LmF0dHIoJ2RhdGEtdmFsdWUnLCB2YWx1ZSk7XG5cdFx0dmFsdWVDb250YWluZXIuaHRtbCh2YWx1ZSk7XG5cdH0pO1xufSJdLCJmaWxlIjoibWFpbi5qcyJ9
