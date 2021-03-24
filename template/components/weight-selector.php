<div class="weight-selector">
	<? foreach($weights as $weight): ?>
		<? if(isset($weight['url']) and $weight['url']): ?>
			<a href="<?= $weight['url'] ?>" class="no-style">
		<? endif ?>
		<div class="weight <? if(isset($weight['selected']) and $weight['selected']) echo 'selected'; ?>" data-value="<?= $weight['val'] ?>">
			<span class="value"></span> 
		</div> 
		<? if(isset($weight['url']) and $weight['url']): ?>
			</a>
		<? endif ?>
	<? endforeach ?>
	<span class="unit">грам</span>
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