<? $this -> extends_from('base-page') ?>

<div class="page-wrap contacts-page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5 col-xl-5">
				<?= $this -> join('components/contactblock') ?>
			</div>
			<div class="col-12 col-lg-6 col-xl-6 offset-lg-1 offset-xl-1">
				<div class="contact-data">
					<h3 class="title">
						<?= $post -> post_title ?>
					</h3>
					<p class="text">
						<?= $post -> post_content ?>
					</p>
					<div class="contact-info">
						<div class="phone-group">
							<div class="phone">
								<ion-icon name="call-outline"></ion-icon>
								<?= get_field('phone_1') ?>
							</div>
							<div class="phone">
								<ion-icon name="call-outline"></ion-icon>
								<?= get_field('phone_2') ?>
							</div>
							<div class="phone-info">
								<?= get_field('time_to_call') ?>
							</div>
						</div>
						<div class="email">
							<ion-icon name="mail-outline"></ion-icon>
							<?= get_field('email') ?>
						</div>
						<div class="location">
							<ion-icon name="location-outline"></ion-icon>
							<?= get_field('address') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>