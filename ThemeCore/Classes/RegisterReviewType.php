<?php

namespace ThemeCore\Classes;

class RegisterReviewType{
	public function __construct(){
		add_action('init', function(){
			register_post_type('review', [
				'label'  => null,
				'labels' => [
					'name'               => 'Отзывы', // основное название для типа записи
					'singular_name'      => 'Отзыв', // название для одной записи этого типа
					'add_new'            => 'Добавить отзыв', // для добавления новой записи
					'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
					'new_item'           => 'Новый отзыв', // текст новой записи
					'view_item'          => 'Просмотр отзыва', // для просмотра записи этого типа.
					'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
					'not_found'          => 'Отзывов не найдено', // если в результате поиска ничего не было найдено
					'not_found_in_trash' => 'Отзывов не найдено в корзине', // если не было найдено в корзине
					'parent_item_colon'  => '', // для родителей (у древовидных типов)
					'menu_name'          => 'Все отзывы', // название меню
				],
				'description'         => 'Тип записи отзыв',
				'public'              => true,
				'publicly_queryable'  => true, // зависит от public
				'exclude_from_search' => false, // зависит от public
				'show_ui'             => true, // зависит от public
				'show_in_nav_menus'   => true, // зависит от public
				'show_in_menu'        => true, // показывать ли в меню адмнки
				'show_in_admin_bar'   => true, // зависит от show_in_menu
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => 'review', // $post_type. C WP 4.7
				'menu_position'       => 4,
				'menu_icon'           => '/wp-content/themes/honey/reviews-icon.png',
				'capability_type'   => 'post',
				// 'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				'map_meta_cap'      => true, // Ставим true чтобы включить дефолтный обработчик специальных прав
				// 'hierarchical'        => false,
				'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => ['post'],
				'has_archive'         => true,
				// 'rewrite'             => ['slug' => 'magicman'],
				'query_var'           => true,
			] );
		});
	}
}
