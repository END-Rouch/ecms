<?php
echo get_tpl('header.php', '{news_title}', '{news_text_min}', '{news_tags_text}', $_SERVER['REQUEST_URI']);
?>
<div class="news">
	<div class="time">{news_date}</div>
	<div class="line"></div>
	<div class="title">{news_title}</div>
	<div class="category"><a href="{_HTTP_SERVER_}category/show/{news_category_href}.html">{news_category}</a></div>
	<div class="user_add"><a href="{_HTTP_SERVER_}user/profile/{news_by_href}.html">{news_by}</a></div>
	<div class="text">
		{news_text}
	</div>
	<div class="line"></div>
	{news_tags}
</div>
<?php
echo get_tpl('footer.php');
?>