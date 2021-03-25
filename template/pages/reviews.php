<? $this -> extends_from('base-page') ?>

<div class="page-wrap reviews-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-10 col-xl-10 offset-lg-1 offset-xl-1">
				<h3 class="page-title"><?= $post -> post_title ?></h3>
			</div>
			<div class="col-12">
				<div class="col-12 col-lg-10 col-xl-10 offset-lg-1 offset-xl-1 main">
					<div class="row">
						<div class="col-12 col-md-6 col-lg-6 col-xl-6">
							<div class="review-screen">
								<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/iphone.png" alt="" class="screen-placeholder">
								<img src="" alt="" class="screen">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6 col-xl-6">
							<div class="reviews-list">
								<ul>
									<?php foreach ($reviews as $i => $review): ?>
										<li class="review-item" data-screen="<?= $review['screenshot'] ?>">
											<img src="<?= $review['avatar'] ?>" alt="<?= $review['nickname'] ?>" class="insta-avatar">
											<div class="insta-info">
												<a href="<?= $review['insta_account_link'] ?>" target="_blank" class="insta-link">@<?= $review['nickname'] ?></a>
												<div class="date"><?= $review['review_timestamp'] ?></div>
											</div>
										</li>
									<?php endforeach ?>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?= $this -> join('components/hot-products', ['post' => $post]) ?>
</div> 

<script>
	$(document).ready(function(){
		const reviews = $('.review-item');
		const screenViewer = $('.screen');
		$(reviews[0]).addClass('active');
		screenViewer.attr('src', $(reviews[0]).attr('data-screen'));

		reviews.on('click', function(){
			const review = $(this);
			const screen = review.attr('data-screen');
			reviews.removeClass('active');
			review.addClass('active');

			screenViewer.attr('src', screen);
		});
	});
</script>