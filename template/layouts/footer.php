	<? 
		$cpost = get_page_by_path('contacts', OBJECT);
		$phones = [
			get_post_meta($cpost -> ID, 'phone_1'), 
			get_post_meta($cpost -> ID, 'phone_2')
		];
		$address = get_post_meta($cpost -> ID, 'address');
		$email = get_post_meta($cpost -> ID, 'email');
		$call_time = get_post_meta($cpost -> ID, 'time_to_call');

		$nav_items_footer = get_navitems('footer');
		$nav_items_social = get_navitems('social');
	?>

	<footer class="footer">
		<div class="container top-line">
			<div class="row">
				<div class="col-3 d-none d-xl-block">
					<img src="<?= get_stylesheet_directory_uri() ?>/html/build/img/footer-logo.png" alt="Footer logo" class="logo">
				</div>
				<div class="col-md-7 col-lg-8 col-xl-6">
					<nav class="navigation">
						<? if(!function_exists('render_navlist')) $this -> join('layouts/navlist'); ?>
						<? render_navlist($nav_items_footer) ?>
					</nav>

					<ul class="contact-links">
						<? foreach ($nav_items_social as $i => $item): ?>
							<li>
								<a 
									href="<?= $item -> url ?>" 
									target="_blank" 
									class="soc-link <?= $item -> title ?>"
								></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				<div class="col-md-5 col-lg-4 col-xl-3">
					<div class="contact-info">
						<div class="phone-group">
							<div class="row">
								<div class="col-4 col-md-5 col-lg-5 col-xl-4 icon-container">
								</div>
								<div class="col-8 col-md-7 col-lg-7 col-xl-8">
									<? foreach($phones as $phone): ?>
										<div class="phone"><?= $phone[0] ?></div>
									<? endforeach ?>
									<div class="phone-info"><?= $call_time[0] ?></div>
								</div>
							</div>
						</div>
						<div class="email">
							<?= $email[0] ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-line">
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-4 col-xl-4">
						<a href="#">Політика конфіденційності</a>
					</div>
					<div class="col-12 col-lg-4 col-xl-4 copyright">
						&copy; 2021
					</div>
					<div class="col-12 col-lg-4 col-xl-4 address">
						<?= $address[0] ?>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

	<? wp_footer() ?>
	<style>
		#wpadminbar{
			display: none;
		}
	</style>
</body>
</html>