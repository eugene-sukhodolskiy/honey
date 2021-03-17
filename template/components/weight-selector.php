<div class="weight-selector">
	<? foreach($weights as $weight): ?>
		<div class="weight <? if($weight['selected'] === true) echo 'selected'; ?>" data-value="<?= $weight['val'] ?>">
			<span class="value"></span> 
		</div> 
	<? endforeach ?>
	<span class="unit">грамм</span>
</div>
  
<script>
	$(document).ready(function(){
		const witems = $('.weight-selector .weight');
		for(let item of witems){
			item = $(item);
			const val = item.attr('data-value');
			const size = 50 + (50 * val);
			item.find('.value').html(val * 1000);
			item.css({
				width: `${size}px`,
			});

			if(item.hasClass('selected')){
				$('.weight-selector').addClass('already-selected');
			}
		}

		$(witems).on('click', function(){
			$(witems).removeClass('selected');
			$(this).addClass('selected');
			$('.weight-selector').addClass('already-selected');
		});
	});
</script>