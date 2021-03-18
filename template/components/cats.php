<? $nav_items_cats = get_navitems('cats'); ?>

<div class="cats">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6 categories">
				<ul class="category-list">
					<? foreach($nav_items_cats as $i => $pcat): ?>
						<? 
							$thumbnail_id = get_term_meta($pcat -> object_id, 'thumbnail_id', true ); 
							$image = wp_get_attachment_url($thumbnail_id); 
						?>
						<li class="cat-item">
							<a href="<?= $pcat -> url ?>" class="cat-link">
								<div class="row">
									<div class="col-3 cat-icon-container">
										<img src="<?= $image ?>" alt="" class="cat-icon">
									</div>
									<div class="col-9">
										<?= $pcat -> title ?>
									</div>
								</div>
							</a>
						</li>
					<? endforeach ?>
				</ul>	
			</div>
			<div class="col-12 col-lg-6 col-xl-6 big-cat-img-container">
				<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/honey_Монтажная область 1@1X.png" class="big-cat-img" alt="">
			</div>
		</div>
	</div>
</div>		