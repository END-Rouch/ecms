<?php
echo get_tpl('header.php', '{user_title}');
?>
<div class="box">
	<h1 class="lalign">{user_title}</h1>
	<div class="lcont"><img class="ava" src="{avatar}" alt="{user_title}" /></div>
	<div class="rcont">
		<div class="uinfo">
			<ul>
				<li>
					<div class="param">{lang=status}:</div>
					<div class="result">{user_last_visit}</div>
				</li>
				<li>
					<div class="param">{lang=group}:</div>
					<div class="result">{groupid}</div>
				</li>
				<li>
					<div class="param">{lang=email}:</div>
					<div class="result">{user_email}</div>
				</li>
				<li>
					<div class="param">{lang=about}:</div>
					<div class="result">{user_status}</div>
				</li>
				[guest_hide]
				<li>
					<div class="param">{lang=balance}:</div>
					<div class="result">{user_balance}</div>
				</li>
				[/guest_hide]
				<li>
					<div class="param">{lang=create_account}:</div>
					<div class="result">{user_register}</div>
				</li>
				<li>
					<div class="param">{lang=last_visit}:</div>
					<div class="result">{user_visit}</div>
				</li>
				<li>
					<div class="param">{lang=topics}:</div>
					<div class="result">{user_count_topic}</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
echo get_tpl('footer.php');
?>