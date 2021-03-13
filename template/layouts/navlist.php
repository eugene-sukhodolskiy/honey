<?
	function render_navlist($nav_items, $parent_id = false){ 
		$nav_items = array_filter($nav_items, function($i) use($parent_id) {
			return $parent_id === false or $i -> menu_item_parent == $parent_id;
		}); 

		if(!$nav_items) return false;
		$count = count($nav_items);
		$skip = 0;
?>

	<ul class="nav-list">
		<? foreach($nav_items as $i => $item): ?>
			<? if($skip){ $skip--; continue; } ?>
			<li class="nav-item <? if(is_current_cat($item)): ?>active<? endif ?>">
				<a href="<?= $item -> url ?>" class="nav-link"><?= $item -> title ?></a>
				<? $total_number_of_render = render_navlist($nav_items, $item -> ID); ?>
				<? if($total_number_of_render): ?>
					<? $skip = $total_number_of_render ?>
					<!-- <ion-icon class="caret" name="caret-down-outline"></ion-icon> -->
				<? endif ?>
			</li>
		<? endforeach ?>
	</ul>

<? return $count; } ?>