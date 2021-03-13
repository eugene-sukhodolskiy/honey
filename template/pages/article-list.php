<? $this -> extends_from('base-page') ?>
<h2 class="page-heading"><?= $page_heading ?></h2>
<main>
	<? foreach($posts as $post): ?>
		<?= $this -> join('components/cards/article', ['post' => $post]) ?>
	<? endforeach ?>
</main>
<?= $this -> join('components/paginator') ?>