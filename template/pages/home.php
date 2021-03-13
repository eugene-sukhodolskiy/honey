<!-- HOME -->
<? $this -> extends_from('base-page') ?>

<main>
	<article class="block">
		<?= $post -> post_content ?>
	</article>
</main>

<div class="block">
	<h2 class="page-heading">Последние добавленные маги</h2>
	<div class="row">
		<? $magicmans = get_posts(['post_type' => 'magicman', 'numberposts' => 4]) ?>
		<? foreach($magicmans as $magicman): ?>
			<div class="col-12 col-lg-6 col-xl-6">
				<?= $this -> join('components/cards/magicman', ['post' => $magicman]); ?>
			</div>
		<? endforeach; ?>
	</div>
</div>


<div class="block">
	<h2 class="page-heading">Последние добавленные статьи</h2>
	<div class="row">
		<? $posts = get_posts(['post_type' => 'зщыеы', 'numberposts' => 3]) ?>
		<? foreach($posts as $post): ?>
			<div class="col-12">
				<?= $this -> join('components/cards/article', ['post' => $post]); ?>
			</div>
		<? endforeach; ?>
	</div>
</div>

<div class="block">
	<? list($bottom_page_text) = get_post_meta(get_the_ID(), 'bottom_page_text') ?>
	<div class="attractive">
		<?= $bottom_page_text ?>
	</div>
</div>
