<?php

namespace ThemeCore\Classes;

class RegisterMagicmanType{
	public function __construct(){
		add_action('init', function(){
			register_post_type('magicman', [
				'label'  => null,
				'labels' => [
					'name'               => 'Маги', // основное название для типа записи
					'singular_name'      => 'Маг', // название для одной записи этого типа
					'add_new'            => 'Добавить мага', // для добавления новой записи
					'add_new_item'       => 'Добавление мага', // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => 'Редактирование мага', // для редактирования типа записи
					'new_item'           => 'Новый маг', // текст новой записи
					'view_item'          => 'Просмотр мага', // для просмотра записи этого типа.
					'search_items'       => 'Искать мага', // для поиска по этим типам записи
					'not_found'          => 'Магов не найдено', // если в результате поиска ничего не было найдено
					'not_found_in_trash' => 'Магов не найдено в корзине', // если не было найдено в корзине
					'parent_item_colon'  => '', // для родителей (у древовидных типов)
					'menu_name'          => 'Все маги', // название меню
				],
				'description'         => 'Тип записи маг',
				'public'              => true,
				'publicly_queryable'  => true, // зависит от public
				'exclude_from_search' => false, // зависит от public
				'show_ui'             => true, // зависит от public
				'show_in_nav_menus'   => true, // зависит от public
				'show_in_menu'        => true, // показывать ли в меню адмнки
				'show_in_admin_bar'   => true, // зависит от show_in_menu
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => 'magicman', // $post_type. C WP 4.7
				'menu_position'       => 4,
				'menu_icon'           => '/wp-content/themes/ukrmagic-redesign/css-pack/resources/logo-20.png',
				'capability_type'   => 'post',
				// 'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				'map_meta_cap'      => true, // Ставим true чтобы включить дефолтный обработчик специальных прав
				// 'hierarchical'        => false,
				'supports'            => ['title','editor','thumbnail','excerpt','comments','custom-fields','revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => ['post', 'category', 'post_tag'],
				'has_archive'         => true,
				// 'rewrite'             => ['slug' => 'magicman'],
				'query_var'           => true,
			] );
		});
	}
}
