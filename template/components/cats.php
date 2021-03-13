<div class="tags">
	<? if(isset($label) and strlen($label)): ?>
		<h3 class="tags-label"><?= $label ?></h3>
	<? endif; ?>

	<? foreach ($cats as $i => $cat): ?>
		<a href="<?= get_category_link($cat); ?>?post_type=magicman" class="tag"><?= $cat -> name ?></a>
	<? endforeach; ?>
</div>
