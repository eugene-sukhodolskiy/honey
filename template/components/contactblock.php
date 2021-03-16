<div class="contact-form">
	<h3 class="title">Напиши нам прямо зараз</h3>
	<form action="" id="contact" method="post">
		<div class="notification">
			<h3 class="msg">Дякую за ваш меседж</h3>
			<ion-icon name="happy-outline"></ion-icon>
		</div>

		<div class="input-group">
			<input type="text" name="name" class="input" placeholder="Ваше им`я *" required="">
		</div>
		<div class="input-group">
			<input type="phone" name="phone" class="input" placeholder="Контактний номер телефону *" required="">
		</div>
		<div class="input-group">
			<input type="email" name="email" class="input" placeholder="Контактний E-mail *" required="">
		</div>
		<div class="input-group">
			<textarea name="msg" class="input" placeholder="Текст листа" required=""></textarea>
		</div>
		<div class="input-group">
			<button class="button">
				Написати 
				<ion-icon name="send-outline"></ion-icon>
			</button>
		</div>
	</form>

	<script>
		$(document).ready(function(){
			const form = $('#contact');
			const inputs = form.find('.input');
			const url = form.attr('action');
			const method = form.attr('method');
			const notification = form.find('.notification');

			form.on('submit', function(e){
				e.preventDefault();
				let data = new FormData(this);
				
				notification.addClass('show');
				setTimeout(function(){
					notification.removeClass('show');
					inputs.val('');
				}, 3000);
				// $.ajax({
				// 	method: method,
				// 	url: url,
				// 	data: data
				// }).done(function(){
				// 	console.log('Done');
				// 	notification.addClass('show');
				// }).failed(function(){
				// 	console.log('Failed');
				// });
			});
		});
	</script>

</div>