<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<? wp_head() ?>

	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/html/bower_components/bootstrap/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/html/bower_components/normalize.css/normalize.css">
	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/html/bower_components/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/html/build/css/main.css">

	<script src="<?= get_stylesheet_directory_uri() ?>/html/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= get_stylesheet_directory_uri() ?>/html/bower_components/slick-carousel/slick/slick.min.js"></script>
	<script src="<?= get_stylesheet_directory_uri() ?>/html/build/js/main.js"></script>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>