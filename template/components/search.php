<div class="searchbar">
	<div class="form-container search-input-container">
		<input type="text" class="input search-input" id="some-input" name="" placeholder="Поиск">
		<div class="search-results-container">
			<ul class="search-results-list">
				<span class="dif no-results">Ничего не найдено</span>
			</ul>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		const searchInput = $('.search-input');
		const resultContainer = $('.search-results-list');

		searchInput.on('input', function(){
			const sword = $(this).val();
			if(sword.length){
				$.ajax({
					url: '/wp-admin/admin-ajax.php',
					method: 'post',
					data: {
						action: 'custom_search',
						search: sword
					}
				}).done(function(resp){
					let result = JSON.parse(resp);
					let posts = result.posts;
					let html = posts.length ? '' : '<span class="dif no-results">Ничего не найдено</span>';
					for(let i=0; i<posts.length; i++){
						html += `<li class="search-result-item">
											<a href="` + posts[i].guid + `" class="transparent-link">` + posts[i].post_title + `</a>
										</li>`
					}
					resultContainer.html(html);
				});
			}

			if(sword.length){
				$(this).parent().addClass('show-results');
			}else{
				$(this).parent().removeClass('show-results');
			}
		}).on('blur', function(){
			$(this).parent().removeClass('show-results');
		}).on('focus', function(){
			const sword = $(this).val();
			if(sword.length){
				$(this).parent().addClass('show-results');
			}
		});
	});
</script>