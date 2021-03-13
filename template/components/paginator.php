<?
	global $wp_query;
	$cat_id = get_cat_ID(single_cat_title('', 0));
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$posts_per_page = get_option('posts_per_page');
	$total_post_count = is_category() ? get_category($cat_id) -> category_count : wp_count_posts() -> publish;
	$total_pages = ceil($total_post_count / $posts_per_page);

	$urlparts = explode('?', $_SERVER['REQUEST_URI']);
	$urlparts[1] = (!isset($urlparts[1])) ? $urlparts[1] = '' : '?'.$urlparts[1];
	$url_raw_arr = explode("page/{$paged}", $urlparts[0]);
	(count($url_raw_arr) !== 1) ?: $url_raw_arr[] = '';
?>

<? if($total_pages > 1): ?>
	<div class="paginator">
		<? if($paged > 1): ?>
			<a href="<?= implode("page/".($paged - 1), $url_raw_arr); ?><?= $urlparts[1] ?>" class="pag-prev"></a>
		<? endif ?>

		<? for($i=1; $i<=$total_pages; $i++): ?>
			<a href="<?= implode("page/{$i}", $url_raw_arr) ?><?= $urlparts[1] ?>" class="pag-item <? if($i == $paged) echo 'active' ?>"><?= $i ?></a>
		<? endfor ?>
		
		<? if($paged < $total_pages): ?>
			<a href="<?= implode("page/".($paged + 1), $url_raw_arr); ?><?= $urlparts[1] ?>" class="pag-next"></a>
		<? endif ?>
	</div>
<? endif; ?>