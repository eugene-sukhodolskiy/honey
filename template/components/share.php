<div class="share">
	<span class="share-label">
		Поделиться
	</span>
	<a class="transparent-link share-link share-ok" href="#share-ok" data-share="ok"></a>
	<a class="transparent-link share-link share-vk" href="#share-vk" data-share="vk"></a>
	<a class="transparent-link share-link share-twitter" href="#share-twitter" data-share="twitter"></a>
	<a class="transparent-link share-link share-facebook" href="#share-facebook" data-share="fb"></a>
</div>

<script>
	let share_url = document.location;
	$(document).ready(function(){
		$('[data-share]').on('click', function(e){
			e.preventDefault();
			let page_description = $('meta[name="description"]').attr('value');
			let page_title = $('title').html();
			let page_thumbnail = $('.page-thumbnail:eq(0)').attr('src');
			Share[$(this).attr('data-share')](page_title, page_description, page_thumbnail);
		});
	});
	
	const Share = {
		vk: function(ptitle, text, pimg) {
			url  = 'http://vkontakte.ru/share.php?';
			url += 'url='          + encodeURIComponent(share_url);
			url += '&title='       + encodeURIComponent(ptitle);
			url += '&description=' + encodeURIComponent(text);
			url += '&image='       + encodeURIComponent(pimg);
			url += '&noparse=true';
			Share.popup(url);
		},
		ok: function(text) {
			url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
			url += '&st.comments=' + encodeURIComponent(text);
			url += '&st._surl='    + encodeURIComponent(share_url);
			Share.popup(url);
		},
		fb: function(ptitle, text, pimg) {
			console.log(ptitle, text, pimg)
			url  = 'http://www.facebook.com/sharer.php?s=100';
			url += '&p[title]='     + encodeURIComponent(ptitle);
			url += '&p[summary]='   + encodeURIComponent(text);
			url += '&p[url]='       + encodeURIComponent(share_url);
			url += '&p[images][0]=' + encodeURIComponent(pimg);
			Share.popup(url);
		},
		twitter: function(ptitle) {
			url  = 'http://twitter.com/share?';
			url += 'text='      + encodeURIComponent(ptitle);
			url += '&url='      + encodeURIComponent(share_url);
			url += '&counturl=' + encodeURIComponent(share_url);
			Share.popup(url);
		},
		mailru: function(ptitle, text, pimg) {
			url  = 'http://connect.mail.ru/share?';
			url += 'url='          + encodeURIComponent(share_url);
			url += '&title='       + encodeURIComponent(ptitle);
			url += '&description=' + encodeURIComponent(text);
			url += '&imageurl='    + encodeURIComponent(pimg);
			Share.popup(url)
		},

		popup: function(url) {
			window.open(url,'','toolbar=0,status=0,width=626,height=436');
		}
	};
</script>