<?php

function is_current_cat($nav_item){
	if(is_single()){
		if(in_category($nav_item -> object_id)){
			return true;
		}
	}else{
		if(is_category($nav_item -> object_id))
			return true;
	}
	return false;
}

function get_comments_to_post($postid){
	$comments = get_comments(['post_id' => $postid, 'orderby' => 'id', 'order' => 'ASC']);
	$comments = array_filter($comments, function($item){
		return $item -> comment_approved;
	});
	return $comments;
}

function get_related_posts(){
	global $post;
 
	$related_tax = 'category';
	$cats_tags_or_taxes = wp_get_object_terms( $post->ID, $related_tax, array( 'fields' => 'ids' ) );
 
	$args = array(
		'posts_per_page' => 4,
		'tax_query' => array(
			array(
				'taxonomy' => $related_tax,
				'field' => 'id',
				'include_children' => false,
				'terms' => $cats_tags_or_taxes,
				'operator' => 'IN'
			)
		)
	);

	$query = new WP_Query( $args );

	return $query -> posts;
}

function get_navitems($menu_name){
	$locations = get_nav_menu_locations();
	$nav_items = wp_get_nav_menu_items($locations[$menu_name]); 
	return $nav_items;
}

function get_template_ins(){
	return $template_ins = new \ThemeCore\Template\Template(__DIR__ . '/..', 'template');
}

function get_profile_custom_fields($post_id, $fields){
	$data = [];
	foreach($fields as $field){
		$data[$field] = get_post_meta($post_id, $field, true);
	}

	return $data;
}

function get_profile_tags_string($p){
	$tags = get_the_terms($p -> ID, 'post_tag');
	$tags = array_map(function($tag){
		return $tag -> name;
	}, $tags ? $tags : []);
	$str = implode(', ', (is_array($tags) and count($tags)) ? $tags : []);
	return $str ? $str : $p -> post_excerpt;
}

function translateMonthName($date_string){
	$vocab = [
		"January" => "Январь",
		"February" => "Февраль",
		"March" => "Март",
		"April" => "Апрель",
		"May" => "Май",
		"June" => "Июнь",
		"July" => "Июль",
		"August" => "Август",
		"September" => "Сентябрь",
		"October" => "Октябрь",
		"November" => "Ноябрь",
		"December" => "Декабрь",
	];

	foreach($vocab as $eng => $rus){
		if(strpos($date_string, $eng) === false){
			continue;
		}
		return str_replace($eng, $rus, $date_string);
	}
}

function https_request($url){ 
  $options = array(
    \CURLOPT_RETURNTRANSFER => true,     // return web page
    \CURLOPT_HEADER         => false,    // don't return headers
    \CURLOPT_FOLLOWLOCATION => true,     // follow redirects
    \CURLOPT_ENCODING       => "",       // handle all encodings
    \CURLOPT_USERAGENT      => "server", // who am i
    \CURLOPT_AUTOREFERER    => true,     // set referer on redirect
    \CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
    \CURLOPT_TIMEOUT        => 120,      // timeout on response
    \CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    \CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
  );

  $ch      = curl_init( $url );
  curl_setopt_array( $ch, $options );
  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  $header['errno']   = $err;
  $header['errmsg']  = $errmsg;
  $header['content'] = $content;

	return $content;
}

function dd($var, $die_flag = true){
	ob_start();
	var_dump($var);
	$dump = ob_get_clean();

	// style
	$style = '
		<style type="text/css">
			.dd-container{
				width: 100%;
				box-sizing: border-box;
				height: auto;
				padding: 20px 10px;
				background-color: #333;
				color: white;
			}
			.dd-container *{
		    font-family: Arial;
  			letter-spacing: .8px;
			}
			.dd-line{
				padding: 5px 20px;
			}
			.dd-margin{
				margin-left: 30px;
			}
			.dd-arrow{
				font-weight: bold;
				padding: 0 10px;
				color: #D9CB04;
			}
			.dd-key{
				font-weight: bold;
				padding: 0 3px;
				color: #038C8C;
			}
			.dd-key-border{
				color: #026873;
			}
			.dd-keyword{
				font-weight: bold;
				color: #D9B504;
				margin-right: 5px;
			}
			.dd-brackets-content{
				font-weight: bold;
				padding: 0 3px;
				color: #F28D77;
			}
			.dd-block{
				display: none;
			}
			.dd-block.show{
				display: block;
			}
			.dd-btn{
		    display: inline-block;
		    color: #7ED955;
		    background: transparent;
		    padding: 0;
		    width: 20px;
		    height: 20px;
		    cursor: pointer;
		    text-align: center;
		    outline: none;
		    font-size: 16px;
		    line-height: 18px;
		    border: 2px solid #7ED955;
			}
			.dd-block-show,
			.dd-block-hide{
        margin-top: -29px;
		    position: relative;
		    left: -10px;
		    float: right;
			}
			.dd-block-hide{
				line-height: 16px;
				color: #F28D77;
				border-color: #F28D77;
			}
		</style>
	';

	// JAVASCRIPT
	$js = '<script>
		let ddJS = function(){
			let btnsShow = document.getElementsByClassName("dd-block-show");
			for(let i in btnsShow){
				let btn = btnsShow[i];
				btn.onclick = function(){
					this.style.display = "none";
					let block = document.getElementsByClassName("dd-block-id-" + this.dataset.blockShow)[0];
					block.classList.add("show");
				}
			}
			let btnsHide = document.getElementsByClassName("dd-block-hide");
			for(let i in btnsHide){
				let btn = btnsHide[i];
				btn.onclick = function(){
					document.querySelector("[data-block-show=\"" + this.dataset.blockHide + "\"]").style.display = "inline-block";
					let block = document.getElementsByClassName("dd-block-id-" + this.dataset.blockHide)[0];
					block.classList.remove("show");
				}
			}
		}
		ddJS();
	</script>';

	$lines = explode("\n", $dump);
	$prev_lvl = 0;
	$cur_lvl = 1;
	foreach ($lines as $inx => $line) {
		$two_space = '<span class="dd-margin"></span>';
		$len = strlen($line);
		$count_spaces = 0;		

		for($i=0; $i<$len; $i++){
			if($line[$i] != " "){
				$count_spaces = $i;
				break;
			}
		}

		$line = mb_substr($line, $count_spaces, $len);
		for($i=0; $i<$count_spaces / 2; $i++){
			$line = $two_space . $line;
		}

		$lines[$inx] = '<div class="dd-line">' . $line . '</div>';

		$cur_lvl = $count_spaces / 2;
		if($prev_lvl < $cur_lvl){
			$bid = uniqid('', $inx);
			$lines[$inx] = '
			<button class="dd-btn dd-block-show" data-block-show="' . $bid . '">+</button>
			<div class="dd-block dd-block-lvl-
			' . $cur_lvl . ' dd-block-id-' . $bid . '">
			<button class="dd-btn dd-block-hide" data-block-hide="' . $bid . '">-</button>
			' . $lines[$inx];
		}

		if($prev_lvl > $cur_lvl){
			$lines[$inx] .= '</div>';
		}

		$prev_lvl = $cur_lvl;

	}

	$dump = implode('', $lines);

	$dump = str_replace('=>', '<span class="dd-arrow">>></span>', $dump);
	$dump = str_replace('["', '<span class="dd-key-border">["</span><span class="dd-key">', $dump);
	$dump = str_replace('"]', '</span><span class="dd-key-border">"]</span>', $dump);

	// keywords
	$keywords = ['array', 'string', 'int', 'float', 'double', 'object'];
	$formating_keywords = array_map(function($item){
		return '<span class="dd-keyword">' . $item . '</span>';
	}, $keywords);
	$dump = str_replace($keywords, $formating_keywords, $dump);

	// brackets content
	$dump = str_replace('(', '(<span class="dd-brackets-content">', $dump);
	$dump = str_replace(')', '</span>)', $dump);

	// Print data forming
	$dump = $style . '<div class="dd-container">' . $dump;
	$dump .= '</div>' . $js;

	echo $die_flag ? die($dump) : $dump;
}
