<?php

namespace ThemeCore\Classes;

class TemplateController{
	protected $wp_query;

	public function __construct(){
		global $wp_query;
		$this -> wp_query = $wp_query;
	}

	public function run(){
		if(is_home() or is_front_page()){
			return $this -> front_page();
		}
		elseif(is_page('contacts')){
			return $this -> contacts_page();
		}
		elseif(is_product()){
			return $this -> single_product();
		}
		elseif(is_product_category()){
			return $this -> product_list();
		}
		elseif(is_page()){
			return $this -> simple_single_page();
		}
		elseif(is_category()){
			$cat_name = single_cat_title('', 0);
			return $this -> article_list($cat_name);
		}
		elseif(is_post_type_archive('article')){
			return $this -> article_list('Статьи');
		}
		elseif(is_single() and count($this -> wp_query -> posts) and $this -> wp_query -> posts[0] -> post_type == 'magicman'){
			return $this -> magicman_single();
		}
		elseif(strpos($_SERVER['REQUEST_URI'], "/hen/") !== false){
			return $this -> magicman_single();
		}
		elseif(is_single() and count($this -> wp_query -> posts) and $this -> wp_query -> posts[0] -> post_type == 'post'){
			return $this -> article_single();
		}
	}

	public function front_page(){
		$post = $this -> wp_query -> posts[0];
		return get_template_ins() -> make('pages/home', ['post' => $post]);
	}

	public function article_list($page_heading){
		return get_template_ins() -> make('pages/article-list', [
			'posts' => $this -> wp_query -> posts,
			'page_heading' => $page_heading
		]);
	}

	public function article_single(){
		return get_template_ins() -> make('pages/single-page', ['post' => $this -> wp_query -> posts[0]]);
	}

	public function contacts_page(){
		$post = $this -> wp_query -> posts[0];
		return get_template_ins() -> make('pages/contacts', ['post' => $post]);
	}

	public function simple_single_page(){
		$post = $this -> wp_query -> posts[0];
		return get_template_ins() -> make('pages/single-page', ['post' => $post]);
	}

	public function product_list(){
		$products = wc_get_products([
			'limit' => 20,
			'orderby' => 'date',
    	'order' => 'DESC',
    	'page' => 1,
    	'category' => [ $this -> wp_query -> posts[0] -> post_name ]
		]);
		return get_template_ins() -> make('pages/product-list', [
			'cat' => $this -> wp_query -> posts[0],
			'products' => $products
		]);
	}

	public function single_product(){
		return get_template_ins() -> make('pages/single-product', [
			'product' => wc_get_product()
		]);
	}
}