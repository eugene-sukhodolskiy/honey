<form action="" id="order-form">
	<div class="input-group">
		<input type="text" name="name" class="input" placeholder="ПIБ отримувача *" required="">
	</div>
	<div class="input-group">
		<input type="tel" name="billing_phone" class="input" placeholder="Контактний номер телефону *" required="">
	</div>
	<div class="input-group">
		<input type="email" name="billing_email" class="input" placeholder="Контактний E-mail *" required="">
	</div>

	<h3>Спосiб доставки</h3>
	<div class="input-group">
		<select name="shipping_method" id="" class="input">
			<option value="np">Нова пошта</option>
			<option value="npa">Нова пошта (за адресою)</option>
			<option value="ukr">Укрпошта (доставка 3-4 дні)</option>
			<option value="self">Самовивiз</option>
		</select>

		<input type="hidden" name="shipping_method_value" value="Нова пошта">
	</div>
	<div class="delivery-form-group np-group">
		<div class="input-group">
			<input type="text" name="billing_state" class="input" placeholder="Область отримувача *" required="">
		</div>
		<div class="input-group">
			<input type="text" name="billing_city" class="input" placeholder="Мiсто/село/смт отримувача *" required="">
		</div>
		<div class="input-group">
			<label>
				<span class="label-text">Відділення *</span>
				<input type="number" name="shipping_num" class="input" step="1" min="1" value="1" placeholder="Вiддiленя *" required="">
			</label>
		</div>
	</div>

	<div class="delivery-form-group npa-group">
		<div class="input-group">
			<input type="text" name="state" class="input" placeholder="Область отримувача *" required="">
		</div>
		<div class="input-group">
			<input type="text" name="city" class="input" placeholder="Мiсто/село/смт отримувача *" required="">
		</div>
		<div class="input-group">
			<input type="text" name="street" class="input" placeholder="Вулиця *" required="">
		</div>
		<div class="input-group">
			<input type="text" name="building" class="input" placeholder="Будинок *" required="">
		</div>

		<div class="input-group">
			<label>
				<span class="label-text">Квартира *</span>
				<input type="number" name="apartment" class="input" step="1" min="1" value="1" placeholder="Квартира *" required="">
			</label>
		</div>
	</div>

	<div class="delivery-form-group ukr-group">
		<div class="input-group">
			<input type="text" name="state" class="input" placeholder="Область отримувача *" required="">
		</div>
		<div class="input-group">
			<input type="text" name="city" class="input" placeholder="Мiсто/село/смт отримувача *" required="">
		</div>
		<div class="input-group">
			<label>
				<span class="label-text">Поштовий iндекс *</span>
				<input type="number" name="billing_postcode" class="input" step="1" min="1" value="10000" placeholder="Поштовий iндекс *" required="">
			</label>
		</div>
	</div>

	<h3>Спосiб оплати</h3>
	<div class="input-group">
		<select name="billing_payment_method" id="" class="input">
			<option value="На карту приват банка">На карту приват банка</option>
			<option value="Оплата при отриманні" data-floating="">Оплата при отриманні</option>
			<option value="Готівкою">Готівкою</option>
		</select>
	</div>

	<div class="input-group">
		<textarea name="order_comments" class="input" placeholder="Коментар до замовлення"></textarea>
	</div>

	<div class="input-group">
		<label>
			<input type="checkbox" name="pers-data" class="input" required="" checked="checked">
			<span class="label-text">Даю згоду на обробку персональних даних</span>
		</label>
	</div>

	<div class="input-group">
		<button class="button lg let-order disable">
			Замовити
		</button>
		<div class="button lg processing-text" style="display: none">
			Виконую...
		</div>
		<span class="total-price">
			Всього <span class="value">0</span> грн
		</span>
	</div>

</form>

<script>
	$(document).ready(function(){
		const form = $('#order-form');
		const deliveryMeth = form.find('[name="shipping_method"]');
		const formGroups = form.find('.delivery-form-group');
		const shippingMethodValue = form.find('[name="shipping_method_value"]');
		const cartCounterContainer = $('.product-list-container .counter');
		formGroups.hide();
		formGroups.find('.input').removeAttr('required');
		$(formGroups[0]).show().find('.input').attr('required', '');

		setTimeout(function(){
			if(parseInt(cartCounterContainer.html())){
				$('.let-order').removeClass('disable');
			}
		}, 500);


		deliveryMeth.on('change', function(){
			formGroups.hide();
			const methodSelect = $(this);
			const method = methodSelect.val();
			const formGroup = form.find(`.delivery-form-group.${method}-group`);
			const floatingBillingMethod = form.find('[data-floating]');

			shippingMethodValue.val(methodSelect.find(`[value="${methodSelect.val()}"`).html());
			formGroup.find('.input').attr('required', '');
			formGroup.show();
			if(method == 'self'){
				floatingBillingMethod.hide();
			}else{
				floatingBillingMethod.show();
			}
		});

		form.on('submit', function(e){
			e.preventDefault();
			if(!parseInt(cartCounterContainer.html())){
				return false;
			}

			const data = {
				'action': 'ajax_order',
				'fields': form.serializeArray()
			};

			console.log(data);
			$('.let-order').hide();
			$('.processing-text').show();

			$.ajax({
				method: 'post',
				url: '/wp-admin/admin-ajax.php',
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				enctype: 'multipart/form-data',
				data: data,
				success: function (result) {
					document.location = "/checkout-success";
					console.log(result); // For testing (to be removed)
				},
				error:   function(error) {
					console.log(error); // For testing (to be removed)
				}
			});
		});
	});
</script>