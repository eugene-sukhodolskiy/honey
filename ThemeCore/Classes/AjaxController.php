<?php

namespace ThemeCore\Classes;

class AjaxController{
	public function __construct(){
		add_action('admin_init', function(){
			add_action('wp_ajax_contactblock', [$this, 'contactblock'], 1);
			add_action('wp_ajax_nopriv_contactblock', [$this, 'contactblock'], 1);

			add_action('wp_ajax_insta_set_data', [$this, 'insta_set_data'], 1);
			add_action('wp_ajax_nopriv_insta_set_data', [$this, 'insta_set_data'], 1);
		});
	}

	public function contactblock(){
		$admin_email = get_bloginfo('admin_email');
		$data = [];
		foreach($_POST['data'] as $i => $item){
			$data[$item['name']] = $item['value'];
		}

		$message = "Пользователь с именем {$data['name']} прислал сообщение:\n{$data['msg']}\n\n";
		$message .= "Контактные данные пользователя: \nТел: {$data['phone']}\nEmail: {$data['email']}";

		mail($admin_email, 'Отправлено из контактной формы vichniy-med.com.ua', $message);
		return die(true);
	}

	public function insta_set_data(){
		$data = $_POST['data'];
		$insta_account = get_option('insta_account');
		$count_insta_posts = get_option('count_insta_posts');

		$filename = __DIR__ . "/../../insta.{$insta_account}.cache";
		echo $filename . "\n\n";
		file_put_contents($filename, date()."\n".$data);
		die(true);
	}
}