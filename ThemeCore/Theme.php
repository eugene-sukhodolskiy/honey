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
					'header-left' => 'Header left side',
					'header-right' => 'Header right side',
					'footer' => 'Footer nav',
					'social' => 'Social links'
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

		add_action('admin_menu', function(){
			$this -> render_custom_settings();
		});

		$this -> ajax_controller = new AjaxController();

		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}

	public function render_custom_settings(){
		// field 1
		$id = 'insta_account';
		register_setting('general', $id);
		add_settings_field(
			$id, 
			'Instagram account', 
			function($val){
				$current_val = esc_attr(get_option($val['option_name']));
				echo "<input 
					type=\"text\" 
					name=\"{$val['option_name']}\" 
					id=\"{$val['id']}\" 
					value=\"{$current_val}\" 
					placeholder=\"Instagram account\"
				>";
			}, 
			'general', 
			'default', 
			[ 
				'id' => $id, 
				'option_name' => $id 
			]
		);

		// field 2
		$id = 'count_insta_posts';
		register_setting('general', $id);
		add_settings_field(
			$id, 
			'Количество постов Instagram', 
			function($val){
				$current_val = esc_attr(get_option($val['option_name']));
				echo "<input 
					type=\"number\" 
					name=\"{$val['option_name']}\" 
					id=\"{$val['id']}\" 
					value=\"{$current_val}\" 
					max=\"10\"
					min=\"1\"
					step=\"1\"
					placeholder=\"Количество постов Instagram\"
				>";
			}, 
			'general', 
			'default', 
			[ 
				'id' => $id, 
				'option_name' => $id 
			]
		);
	}
}