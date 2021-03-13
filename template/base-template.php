<? extract($this -> get_inside_data()) ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? wp_head() ?>

	<!-- <link rel="stylesheet" href="/wp-content/themes/ukrmagic-redesign/css-pack/components.css">
	<link rel="stylesheet" href="/wp-content/themes/ukrmagic-redesign/style.css">
	
	<script src="/wp-content/themes/ukrmagic-redesign/css-pack/libs/jquery-3.5.1.min.js"></script>
	<script src="/wp-content/themes/ukrmagic-redesign/css-pack/libs/jquery.custom-scrollbar.js"></script>
	<script src="/wp-content/themes/ukrmagic-redesign/css-pack/components.js"></script>

	<link rel="icon" type="image/png" href="/wp-content/themes/ukrmagic-redesign/css-pack/resources/logo-64.png"> -->
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?= $this -> content() ?>

	<? wp_footer() ?>
</body>
</html>