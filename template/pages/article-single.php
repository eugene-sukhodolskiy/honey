<? $this -> extends_from('base-page') ?>
<?
	$thumbnail = has_post_thumbnail($post) ? get_the_post_thumbnail_url($post, 'large') : null; 
	$thumbnail_alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
	$cats = get_the_category($post);
	$timestamp = translateMonthName(date('d F Y', strtotime($post -> post_date)));
?>

<main>
	<article class="single-page article-single">
		<h1 class="single-page-heading"><?= $post -> post_title ?></h1>
		<? if($thumbnail): ?>
			<img src="<?= $thumbnail ?>" class="single-page-thumbnail" alt="<?= $thumbnail_alt ?>">
		<? endif ?>
		<?= $this -> join('components/cats', ['cats' => $cats, 'label' => 'Категории']) ?>
		<div class="single-page-content">
			<?= $post -> post_content ?>
		</div>
		<span class="dif single-page-timestamp"><?= $timestamp ?></span>
	</article>
	<?= $this -> join('components/share'); ?>
	<?= $this -> join('components/comments', [
		'comments' => get_comments_to_post($post -> ID),
		'comments_number' => get_comments_number($post -> ID)
	]); ?>
	<? if(comments_open($post -> ID)): ?>
		<?= $this -> join('components/commentform', ['post' => $post]); ?>
	<? endif ?>
</main>
