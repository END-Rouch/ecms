<div class="box">
<form method="post" enctype="multipart/form-data" name="setting">
	<h1>{lang=setting}</h1>
	<div class="field">
		<label for="name">{lang=name}:</label>
		<input name="name" id="name" value="{name}" type="text" />
	</div>
	<div class="field">
		<label for="family">{lang=family}:</label>
		<input name="family" id="family" value="{family}" type="text" />
	</div>
	<div class="field">
		<label for="email">{lang=email}:</label>
		<input name="email" id="email" value="{email}" type="text" />
	</div>
	<div class="field">
		<label for="avatar">{lang=avatar}:</label>
		<input name="avatar" id="avatar" type="file" />
	</div>
	<div class="field">
		<label for="about">{lang=about}:</label>
		<input name="about" id="about" value="{about}" type="text" />
	</div>
	<div class="submit">
		<button type="submit">{lang=submit}</button>
	</div>
</form>
<form method="post" name="password">
	<h1>{lang=setting_password}</h1>
	<div class="field">
		<label for="pass_my">{lang=pass_my}:</label>
		<input name="pass_my" id="pass_my" type="password" />
	</div>
	<div class="field">
		<label for="pass_new">{lang=pass_new}:</label>
		<input name="pass_new" id="pass_new" type="password" />
	</div>
	<div class="submit">
		<button type="submit">{lang=submit}</button>
	</div>
</form>
</div>