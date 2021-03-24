<?= $this -> join('layouts/head') ?>

<?
	$nav_items_left = get_navitems('header-left');			
	$nav_items_right = get_navitems('header-right');			
	$current_guid = url_to_postid(get_the_permalink());
?>

<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-4 top-logo-wrap mob">
				<div class="top-logo-container">
					<a href="/">
						<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/top-logo.png" alt="Logo" class="top-logo">
					</a>
				</div>
			</div>
			<div class="col-12 col-xl-4">

				<nav class="navigation left-nav">
					<? if(!function_exists('render_navlist')) $this -> join('layouts/navlist'); ?>
					<? render_navlist($nav_items_left) ?>
				</nav>
			</div>

			<div class="col-4 top-logo-wrap">
				<div class="top-logo-container">
					<a href="/">
						<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/top-logo.png" alt="Logo" class="top-logo">
					</a>
				</div>
			</div>

			<div class="col-12 col-xl-4">
				<a href="/cu-cart" class="basket-button">
					<span class="icon-container">
						<ion-icon name="bag-handle-outline" class="basket-icon"></ion-icon>
					</span>
					<span class="counter">
						<?= \WC() -> cart -> cart_contents_count ?>
					</span>
				</a>

				<button class="menu" data-state="close">
					<span class="state-open">
						<ion-icon name="menu-outline"></ion-icon>
					</span>
					<span class="state-close">
						<ion-icon name="close-outline"></ion-icon>
					</span>
				</button>

				<nav class="navigation right-nav">
					<? render_navlist($nav_items_right) ?>
				</nav>
			</div>
		</div>		
	</div>
</header>
