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
		elseif(is_page('cu-cart')){
			return $this -> custom_cart();
		}
		elseif(is_page('reviews')){
			return $this -> reviews();
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
			'limit' => 80,
			'orderby' => 'date',
    	'order' => 'DESC',
    	'page' => 1,
    	'category' => [ $this -> wp_query -> posts[0] -> post_name ]
		]);

		$with_weight = get_field('with_weight', $this -> wp_query -> posts[0] -> ID);
		
		$template_name = $with_weight ? 'product-list-with-weight' : 'product-list';
		return get_template_ins() -> make('pages/' . $template_name, [
			'cat' => $this -> wp_query -> posts[0],
			'products' => $products
		]);
	}

	public function single_product(){
		return get_template_ins() -> make('pages/single-product', [
			'product' => wc_get_product()
		]);
	}

	public function custom_cart(){
		global $woocommerce;
    $products = $woocommerce -> cart -> get_cart();
    $products = array_map(function($item){
    	return [
    		'product_cart' => $item, 
    		'product' => wc_get_product($item['product_id'])
    	];
    }, $products);

		return get_template_ins() -> make('pages/cart', [
			'products_sets' => $products,
			'post' => $this -> wp_query -> posts[0]
		]);
	}

	public function reviews(){
		$reviews = get_posts([
			'post_type' => 'review',
			'numberposts' => 30,
			'orderby' => 'date',
			'order' => 'DESC'
		]);

		$reviews = array_map(function($review){
			return [
				'id' => $review -> ID,
				'nickname' => get_field('nickname', $review -> ID),
				'insta_account_link' => get_field('insta_account_link', $review -> ID),
				'review_timestamp' => get_field('review_timestamp', $review -> ID),
				'avatar' => get_field('avatar', $review -> ID),
				'screenshot' => get_field('screenshot', $review -> ID)
			];
		}, $reviews);

		return get_template_ins() -> make('pages/reviews', [
			'reviews' => $reviews,
			'post' => $this -> wp_query -> posts[0]
		]);
	}
}