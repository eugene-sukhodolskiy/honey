<?
	$slides = [];
	for($i=1; $i<=10; $i++){
		$slide = get_field("slide_{$i}");
		if(!$slide){
			break;
		}

		$slides[] = $slide;
	}
?>

<div class="carousel">
	<?php foreach ($slides as $i => $slide): ?>
		<img src="<?= $slide ?>" class="slide-img" alt="">
	<?php endforeach ?>
</div>

<script>
	$(document).ready(function(){
		$('.carousel').slick({
			dots: true,
			arows: true,
			autoplay: true,
  		autoplaySpeed: 5000
		});
	});
</script>