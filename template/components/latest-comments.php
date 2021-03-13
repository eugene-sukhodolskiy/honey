<?
	$comments_raw = get_comments([
		'order' => 'desc',
		'number' => 3,
		'status' => 'approve'
	]);

	$comments = [];
	foreach ($comments_raw as $comment) {
		$comments[] = [
			'comment' => $comment,
			'post' => get_post($comment -> comment_post_ID)
		];
	}
?>
<div class="sidebar-block latest-comments-container">
	<h2 class="sidebar-block-heading">Последние комментарии</h2>
	<div class="latest-comments">
		<?php foreach ($comments as $comment): ?>
			<?= $this -> join('components/cards/comment-mini', $comment) ?>
		<?php endforeach ?>
	</div>
</div>