<? $this -> extends_from('base-page'); ?>

<main>
	<div class="page-wrap single-page">
		<?php if (has_post_thumbnail($post)): ?>
			<? $thumb_id = get_post_thumbnail_id($post -> ID) ?>
			<div class="thumbnail">
				<img 
					src="<?= get_the_post_thumbnail_url($post -> ID, 'full') ?>" 
					alt="<?= get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>"
					title="<?= get_the_post_thumbnail_caption($post -> ID) ?>"
				>
			</div>
		<?php endif ?>
		<div class="container">
			<h1 class="title">
				<?= $post -> post_title ?>
			</h1>
			<div class="content">
				<?= do_shortcode($post -> post_content) ?>
			</div>
		</div>
	</div>
</main>