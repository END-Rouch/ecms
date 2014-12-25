<div class="box">
	<h1>{lang=create_topic}</h1>
	<form method="post" name="addtopic">
	<div class="field">
		<label for="name">Название:</label>
		<input name="name" id="name" type="text" />
	</div>
	<div class="field">
		<label for="category">Категория:</label>
		<select id="category" name="category">
			{category_show}
		</select>
	</div>
	<div class="field">
		<label for="min_text">Описание:</label>
		<textarea id="min_text" name="min_text"></textarea>
	</div>
	<div class="field">
		<label for="full_text">Полное описание:</label>
		<textarea id="full_text" name="full_text"></textarea>
	</div>
	<div class="field">
		<label for="tags">Ключевые слова:</label>
		<input name="tags" id="tags" type="text" />
	</div>
	<div class="submit">
		<button type="submit">{lang=submit}</button>
	</div>
	</form>
</div>