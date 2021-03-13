<?php

namespace ThemeCore\Classes;

class AjaxController{
	public function __construct(){
		add_action('admin_init', function(){
			add_action('wp_ajax_custom_search', [$this, 'custom_search'], 1);
			add_action('wp_ajax_nopriv_custom_search', [$this, 'custom_search'], 1);

			add_action('wp_ajax_call_back', [$this, 'call_back'], 1);
			add_action('wp_ajax_nopriv_call_back', [$this, 'call_back'], 1);

			add_action('wp_ajax_vote', [$this, 'vote'], 1);
			add_action('wp_ajax_nopriv_vote', [$this, 'vote'], 1);

			add_action('wp_ajax_contactblock', [$this, 'contactblock'], 1);
			add_action('wp_ajax_nopriv_contactblock', [$this, 'contactblock'], 1);
		});
	}

	public function custom_search(){
		$search_str = trim(strip_tags($_POST['search']));
		$query = new \WP_Query("s={$search_str}&post_type=magicman&numberposts=4");
		$posts = ['posts' => $query -> posts];
		$query = new \WP_Query("s={$search_str}&post_type=post&numberposts=4");
		$posts['posts'] = array_merge($posts['posts'], $query -> posts);

		echo json_encode($posts);
		die();
	}

	function call_back(){
		$admin_email = get_bloginfo('admin_email');
		$magicman_email = trim(strip_tags($_POST['magicman_email']));
		$user_email = trim(strip_tags($_POST['callback_email']));
		$magicman_id = trim(strip_tags($_POST['magicman_id']));

		$magicman_id = $magicman_id ? $magicman_id : false;

		if($magicman_email == '' or $user_email == ''){
			return false;
		}

		$message = "Пользователь с email [{$user_email}] попросил написать ему";
		$headers = array();

		if($magicman_id){
			$this -> message_to_gateway('', $user_email, '', $message, false, $magicman_id);
		}

		mail($magicman_email, 'Обратная связь с сайта Ukrmagic', $message, implode("\r\t", $headers));
		return die(true);
	}

	public function vote(){
		$post_id = intval($_POST['post_id']);
		$feature = get_profile_custom_fields($post_id, ['vote_count']);
		update_post_meta($post_id, 'vote_count', $feature['vote_count'] + 1);
		return die(true);
	}

	public function contactblock(){
		return die(true);
	}

	public function message_to_gateway($username, $email, $phone, $message, $pageurl = '', $idname_of_magicman = ''){
	  $siteurl = "ukrmagic.com";
	  $data = [
	    "site_url" => $siteurl,
	    "username" => $username,
	    "email" => $email,
	    "phone" => $phone,
	    "message" => $message,
	    "page_url" => $pageurl,
	    "magicman_idname" => $idname_of_magicman
	  ];

	  $message = json_encode($data);

	  if($curl = curl_init()) {
	    curl_setopt($curl, CURLOPT_URL, 'http://ma.best-magic.ru/gateway');
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, ['message' => $message]);
	    $out = curl_exec($curl);
	    curl_close($curl);
	  }
	}

}