<div class="personcontact">
	<div class="notidamper" data-id="personcontact-form">
		<div class="notimess">Сообщение успешно отправлено</div>
	</div>

	<div class="personcontact-form">
		<span class="personcontact-form-close"></span>
		<h2 class="percon-heading">Связаться с магом</h2>
		<p class="personcontact-form-description">Оставьте свой Email и в ближайшее время с Вами свяжутся</p>
		<form action="/wp-admin/admin-ajax.php" method="post" id="call_back_form">
			<input type="hidden" name="magicman_email" value="<?= $feature['email'] ?>">
			<input type="hidden" name="magicman_id" value="<?= $feature['magicman_id'] ?>">
			<input type="hidden" name="action" value="call_back">
			<div class="form-container">
				<input type="email" class="input" id="callback_email" name="callback_email" required="">
				<label for="callback_email" class="label">Email</label>
			</div>
			<button class="button primary big submit">Отправить</button>
		</form>
	</div>

	<h1 class="percon-heading">Контакты</h1>
	<a class="link magicman-site" href="<?= $feature['site'] ?>"><?= $feature['site'] ?></a>
	<div class="percon-connect">
		<? if(isset($feature['tg']) and $feature['tg']): ?>
			<a href="<?= $feature['tg'] ?>" class="transparent-link percon-connect-link tg" target="_blank"></a>
		<? endif ?>

		<? if(isset($feature['skype']) and $feature['skype']): ?>
			<a href="<?= $feature['skype'] ?>" class="transparent-link percon-connect-link skype" target="_blank"></a>
		<? endif ?>

		<? if(isset($feature['wa']) and $feature['wa']): ?>
			<a href="<?= $feature['wa'] ?>" class="transparent-link percon-connect-link wa" target="_blank"></a>
		<? endif ?>

		<? if(isset($feature['viber']) and $feature['viber']): ?>
			<a href="<?= $feature['viber'] ?>" class="transparent-link percon-connect-link viber" target="_blank"></a>
		<? endif ?>
	</div>
	<button class="button primary show-form-btn" data-show-form>Связаться с магом</button>
</div>

<script>
	$(document).ready(function(){
		// PERSONCONTACT
		$('[data-show-form]').on('click', function(){
			$('.personcontact-form').addClass('show');
		});

		$('.personcontact-form-close').on('click', function(){
			$('.personcontact-form').removeClass('show');
		});

		$('.personcontact-form #call_back_form').on('submit', function(e){
			e.preventDefault();
			const form = $(this);
			const inps = form.find('[name]');
			let data = {};
			for(let inp of inps){
				data[$(inp).attr('name')] = $(inp).val();
			}

			$.ajax({
				url: form.attr('action'),
				method: form.attr('method'),
				data: data
			}).done(function(resp){
				console.log(resp);
				$('.personcontact').addClass('notishow');
				setTimeout(function(){
					$('.personcontact-form-close').trigger('click');
					$('#callback_email').removeClass('focus').val('');
				}, 1000);
				setTimeout(function(){
					$('.personcontact').removeClass('notishow');
				}, 4000);
			});

		});
	});
</script>