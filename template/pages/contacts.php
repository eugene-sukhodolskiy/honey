<? $this -> extends_from('base-page') ?>
<main>
	<article class="single-page">
		<h2 class="page-heading"><?= $post -> post_title ?></h2>
		<?= $post -> post_content ?>
	</article>
	<div class="block">
		<?= $this -> join('components/contactblock') ?>
	</div>
</main>