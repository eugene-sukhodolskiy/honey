<?= $this -> join('layouts/head') ?>

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
					<ul class="navlist">
						<li class="navitem">
							<a href="#" class="navlink">Головна</a>
						</li>
						<li class="navitem">
							<ul class="navlist">
								<li class="navitem">
									<a href="#" class="navlink">Мед</a>
								</li>
								<li class="navitem">
									<a href="#" class="navlink">Пилок</a>
								</li>
								<li class="navitem">
									<a href="#" class="navlink">Свічки</a>
								</li>
								<li class="navitem">
									<a href="#" class="navlink">Подарункові набори</a>
								</li>
							</ul>	

							<a href="#" class="navlink">Наша продукція</a>
						</li>
					</ul>
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
				<a href="#" class="basket-button">
					<span class="icon-container">
						<ion-icon name="bag-handle-outline" class="basket-icon"></ion-icon>
					</span>
					<span class="counter">6</span>
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
					<ul class="navlist">
						<li class="navitem">
							<a href="#" class="navlink">Контакти</a>
						</li>
						<li class="navitem">
							<a href="#" class="navlink">Про нас</a>
						</li>
						<li class="navitem">
							<a href="#" class="navlink">Відгуки</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>		
	</div>
</header>

<?
	// $nav_items = get_navitems('main');			
	// $current_guid = url_to_postid(get_the_permalink());
	// if(!function_exists('render_navlist')) 
	// 	$this -> join('layouts/navlist');
?>

		<!-- <nav class="navigation"> -->
			<? //if(is_array($nav_items) and count($nav_items)): ?>
				<?// render_navlist($nav_items); ?>
			<? //endif ?>
		<!-- </nav> -->
