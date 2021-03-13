<div class="block contactblock">
	<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">
			<a href="mailto:magicpeople@mail.com" class="transparent-link contactblock-email-link">smagicpeople@mail.com</a>
			<a href="mailto:voodoopeople@mail.com" class="transparent-link contactblock-email-link">voodoopeople@mail.com</a>
			<a href="call:+3 (123) 123 - 45 - 67" class="transparent-link contactblock-phone-link">+3 (123) 123 - 45 - 67</a>
		</div>
		<div class="col-12 col-lg-6 col-xl-6">
			<form action="" method="post" id="contactblock-form" class="contactblock-form with-notidamper">
				<div class="notidamper" data-id="commentform">
					<div class="notimess">Сообщение успешно отправлено</div>
				</div>
				<div class="form-container">
					<input type="text" class="input" id="username" name="username" required="">
					<label for="username" class="label">Имя*</label>
				</div>
				<div class="form-container">
					<input type="email" class="input" id="email" name="email" required="">
					<label for="email" class="label">Email*</label>
				</div>
				<div class="form-container">
					<input type="phone" class="input" id="phone" name="phone" required="">
					<label for="phone" class="label">Номер телефона*</label>
				</div>
				<div class="form-container">
					<textarea class="input" id="message" name="message" required="" placeholder="Сообщение"></textarea>
				</div>
				<button class="button primary big submit">Отправить</button>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#contactblock-form').on('submit', function(e){
			e.preventDefault();
			const form = $(this);
			const inps = form.find('.input[name]');
			form.addClass('notishow');

			setTimeout(function(){
				form.removeClass('notishow');
				$(inps).removeClass('focus').val('');
			}, 1000);

			setTimeout(function(){
				form.removeClass('notishow');
			}, 4000);
		});
	});
</script>