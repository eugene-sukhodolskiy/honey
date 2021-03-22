<?php

namespace ThemeCore\Classes;

class Insta{
	protected $max_life;

	public function __construct($max_life = 60 * 60){ // 60 minutes
		$this -> max_life = $max_life;
	}

	protected function picking($nodes){
		$posts = [];
		foreach ($nodes as $i => $n) {
			$post = [
				'like' => $n['node']['edge_media_preview_like']['count'],
				'src' => $n['node']['thumbnail_resources'][2]['src'],
				'url' => $n['node']['display_url'],
				'text' => $n['node']['edge_media_to_caption']['edges'][0]['node']['text'],
				'shortcode' => $n['node']['shortcode']
			];
			$posts[] = $post;
		}

		return $posts;
	}

	protected function cache_file_name($account){
		return "insta.{$account}.cache";
	}

	protected function set_cache($account, $raw_response){
		return file_put_contents($this -> cache_file_name($account), time() . "\n" . $raw_response);
	}

	protected function get_cache_if_exists($account){
		if(!file_exists($this -> cache_file_name($account))){
			return false;
		}

		$cache_file = file_get_contents($this -> cache_file_name($account));
		list($timestamp, $raw_response) = explode("\n", $cache_file);

		if(time() - $timestamp >= $this -> max_life){
			// expired cache
			return false;
		}

		return $raw_response;
	}

	protected function get_raw_response($account){
		$raw_response = $this -> get_cache_if_exists($account);
		return $raw_response ? $raw_response : $this -> force_recache($account);
	}

	public function force_recache($account){
		// $insta_url = 'https://instagram.com/' . $account . '/?__a=1';
		$insta_url = 'https://instagram.com/' . $account;
		// $raw_response = \https_request($insta_url);
		// $raw_response = file_get_contents($insta_url);
		$response_html = file_get_contents($insta_url);
		$arr = explode('window._sharedData = ', $response_html);
		$json = explode(';</script>', $arr[1]);
		$raw_response = $json[0];
		$this -> set_cache($account, $raw_response);

		return $raw_response;
	}

	public function get_insta_posts($account, $count = 10){
		$raw_response = $this -> get_raw_response($account);
		$data = json_decode($raw_response, true);
		// $nodes = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		$nodes = $data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];

		return array_filter($this -> picking($nodes), function($item, $inx) use($count) {
			return $inx < $count;
		}, ARRAY_FILTER_USE_BOTH);
	}
}