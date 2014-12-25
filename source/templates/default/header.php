<!DOCTYPE html>
<html>
<head>

<meta http-equiv="no-cache">

<meta charset="utf-8" />
{_META_}
{_OGMETA_}
<link rel="stylesheet" href="{_TPL_}css/import.css" />
<link rel="icon" type="image/x-icon" href="{config=http_server}" />

<script src="{_TPL_}js/jquery.js"></script>
<script src="{_TPL_}js/mediaelement-and-player.min.js"></script>
<script src="{_TPL_}js/ecms.js"></script>

</head>
<body>
<div id="wrapper">
	<div class="header">
		<div class="conteiner">
			<div class="logo">{config=sitename}</div>
			<ul class="headmenu">
				[hide]
				<li><a class="start" href="{config=http_server}login/">{lang=auth}</a></li>
				<li><a class="end" href="{config=http_server}register/">{lang=register}</a></li>
				[/hide]
				[guest_hide]
				<li><a class="start" href="{config=http_server}user/profile/{auth_id}.html">{lang=profile}</a></li>
				<li><a class="button" href="{config=http_server}user/setting/">{lang=setting}</a></li>
				<li><a class="button" href="{config=http_server}user/addtopic/">{lang=create_topic}</a></li>
				<li><a class="end" href="{config=http_server}login/boot/">{lang=logout}</a></li>
				[/guest_hide]
			</ul>
		</div>
	</div>
	<div class="conteiner">
		<ul class="menu">
			<?php echo get_menu(); ?>
			<div class="themes" title="{lang=change_style}"></div>
		</ul>
		<div class="search">
			{search_form}
		</div>
		<div class="content">
			<div class="ct-left">
				<div class="block_name">{lang=category}</div>
				<div class="block_content">
					<div class="link">
						<?php echo categoryMenu(); ?>
					</div>
				</div>
				<div class="block_name">{lang=news_new}</div>
				<div class="block_content">
					<div class="link">
						<?php echo newTopics(); ?>
					</div>
				</div>
				<div class="block_name">{lang=users_new}</div>
				<div class="block_content">
					<?php echo new_users(); ?>
					<!--<div class="link">
						<a href="{config=http_server}users/all/" class="align"  title="{lang=users_all}">{lang=users_all}</a>
					</div>-->
				</div>
			</div>
			<div class="ct-right">
			