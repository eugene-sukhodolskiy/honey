<?
$insta_account = get_option('insta_account');
$count_insta_posts = get_option('count_insta_posts');

$insta = new \ThemeCore\Classes\Insta();
$insta_posts = $insta -> get_insta_posts($insta_account, $count_insta_posts);
?>

<div class="insta">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-3 col-xl-3">
				<div class="profile">
					<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/logo@1X.png" class="avatar" alt="avatar">
					<a href="https://instagram.com/<?= $insta_account ?>" class="name" target="_blank">
						<?= $insta_account ?>
					</a>
				</div>
			</div>
			<div class="col-12 col-lg-9 col-xl-9">
				<h3>
					Слідкуй за нами в Instagram
				</h3>
			</div>
		</div>
	</div>

	<div class="post-carousel">
		<? foreach ($insta_posts as $i => $ipost): ?>
			<img 
				src="<?= $ipost['src'] ?>" 
				class="insta-post" 
				alt="<?= htmlspecialchars($ipost['text']) ?>" 
				title="<?= htmlspecialchars($ipost['text']) ?>" 
				data-href="<?= $ipost['url'] ?>"
			>
		<? endforeach ?>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.post-carousel').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			responsive: [
				{
					breakpoint: 1400,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		});
	});	
</script>