<?php

namespace ThemeCore;

use \ThemeCore\Classes\AjaxController;

class Theme{
	public $ajax_controller;

	public function __construct(){
		$this -> setup();
	}

	public function setup(){
		add_action('after_setup_theme', function(){
			add_theme_support('post-thumbnails');
			add_theme_support('widgets');

			register_nav_menus(
				[
					'main' => 'Primary',
				]
			);
		});

		add_action( 'widgets_init', function(){
			register_sidebar( array(
				'name'          => "Footer",
				'id'            => 'footer-sidebar',
				'description'   => 'Footer widgets',
				'class'         => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => "</div>\n",
				'before_title'  => '<h2 class="widgettitle" style="display: none">',
				'after_title'   => "</h2>\n",
			) );
		} );

		$this -> ajax_controller = new AjaxController();
	}
}