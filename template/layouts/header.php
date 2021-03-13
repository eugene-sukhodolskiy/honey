<?
	$nav_items = get_navitems('main');			
	$current_guid = url_to_postid(get_the_permalink());
	if(!function_exists('render_navlist')) 
		$this -> join('layouts/navlist');
?>

<header class="header">
	<div class="container header-container">
		<div class="mob-menu-open"></div>
		<div class="mob-menu-close"></div>
		<nav class="navigation">
			<? if(is_array($nav_items) and count($nav_items)): ?>
				<? render_navlist($nav_items); ?>
			<? endif ?>
		</nav>

		<div class="logo">
			<a href="/">
				<img class="logo-img" src="/wp-content/themes/ukrmagic-redesign/css-pack/resources/logo.png">
			</a>
		</div>

		<div class="searchbar-container">
			<?= $this -> join('components/search') ?>
		</div>
		
	</div>
</header>

<? if(is_front_page()): ?>
	<?= $this -> join('components/topblock') ?>
<? endif ?>