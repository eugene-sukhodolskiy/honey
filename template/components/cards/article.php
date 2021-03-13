<? 
	$link = get_permalink($post);
	$thumbnail = has_post_thumbnail($post) ? get_the_post_thumbnail_url($post, 'thumbnail') : null; 
	$thumbnail_alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
	$timestamp = translateMonthName(date('d F Y', strtotime($post -> post_date)));
	$cats = get_the_category($post);
	$count_comments = wp_count_comments($post -> ID) -> approved;
?>

<div class="card article <? if(!$thumbnail) echo 'no-card-thumbnail' ?>">
	<? if($thumbnail): ?>
		<img src="<?= $thumbnail ?>" class="card-thumbnail" alt="<?= $thumbnail_alt ?>">
	<? endif; ?>
	<div class="card-content">
		<a href="<?= $link ?>" class="transparent-link">
			<h2 class="card-heading"><?= $post -> post_title ?></h2>
		</a>
		<div class="card-description">
			<?= $post -> post_excerpt ?>
		</div>

		<?= $this -> join('components/cats', ['cats' => $cats]); ?>

		<div class="card-control">
			<div class="counters">
				<span class="counter comments-counter"><?= $count_comments ?></span>
			</div>
			<span class="dif timestamp"><?= $timestamp ?></span>
			<a href="<?= $link ?>" class="button primary outline read-btn">Читать</a>
		</div>
	</div>
</div>