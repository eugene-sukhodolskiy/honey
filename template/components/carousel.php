<?
	$slides = [];
	$slides_mob = [];
	$slides_link = [];
	for($i=1; $i<=10; $i++){
		$slide = get_field("slide_{$i}");
		$slide_mob = get_field("slide_mob_{$i}");
		$slide_link = get_field("slide_link_{$i}");
		if($slide){
			$slides[] = $slide;
		}else break;
		
		if($slide_mob){
			$slides_mob[] = $slide_mob;
		
		}
		if($slide_link){
			$slides_link[] = $slide_link;
		}
	}

?>

<div class="carousel">
	<?php foreach ($slides as $i => $slide): ?>
		<a href="<?= $slides_link[$i] ?>">
			<img src="<?= $slide ?>" class="slide-img" alt="">
		</a>
	<?php endforeach ?>
</div>

<div class="carousel mob">
	<?php foreach ($slides_mob as $i => $slide): ?>
		<a href="<?= $slides_link[$i] ?>">
			<img src="<?= $slide ?>" class="slide-img" alt="">
		</a>
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