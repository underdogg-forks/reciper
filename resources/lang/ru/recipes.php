<?php

return [

	// Controller
	'recipe_has_been_saved' => 'Рецепт успешно сохранен',
	'no_rights_to_see' => 'У вас нет права просматривать этот рецепт, так как он еще не опубликован',
	'is_not_written_yet' => 'Этот рецепт находится в процессе написания.',
	'not_approved_yet' => 'Этот рецепт еще не одобрен.',
	'no_rights_to_edit' => 'Вы не можете редактировать не свои рецепты.',
	'recipe_is_published' => 'Рецепт опубликован и доступен для посетителей.',
	'added_to_approving' => 'Рецепт добавлен на рассмотрение и будет опубликован после одобрения администрации.',
	'saved' => 'Рецепт успешно сохранен',
	'you_gave_recipe_back_on_editing' => 'Вы вернули рецепт на повторное редактирование',
	'you_cannot_edit_peoples_recipes' => 'Вы не можете редактировать не свои рецепты',
	'deleted' => 'Рецепт успешно удален',
	
	// Views
	'add_recipe' => 'Добавление рецепта',
	'title' => 'Название',
	'intro' => 'Описание',
	'short_intro' => 'Краткое описание рецепта',
	'ingredients' => 'Ингридиенты',
	'ingredients_description' => 'Все ингридиенты рецепта. После каждого ингридиента нажимайте кнопку Ввод (Enter) чтобы разделить их на строки.',
	'advice' => 'Совет',
	'advice_description' => 'Это поле не обязательно к заполнению, если у вас есть просьба или совет который может помочь в приготовлении блюда пишите его сюда.',
	'text_of_recipe' => 'Приготовление',
	'text_description' => 'Опишите процесс приготовления по пунктам используя Ввод (Enter) для отделения пунктов друг от друга.',
	'category' => 'Категория',
	'time' => 'Время приготовления',
	'time_description' => 'Время приготовления в минутах',
	'image' => 'Изображение',
	'ready_to_publish' => 'Готово к публикации',
	'select_file' => 'Выбрать файл',
	'recipes' => 'Рецепты',
	'like' => 'Нравится',
	'dislike' => 'Не нравится',
	'bon_appetit' => 'Приятного аппетита',
	'added' => 'Добавленно',
	'author' => 'Автор рецепта',
	'more' => 'Еще рецепты',
	'are_you_sure_to_delete' => 'Вы точно хотите удалить этот рецепт?',
	'are_you_sure_to_publish' => 'Вы точно хотите опубликовать этот рецепт?',
	'are_you_sure_to_cancel' => 'Вы точно хотите вернуть этот рецепт автору на доработку?',

	// Listener
	'new_recipe' => config('app.name') . '. Рецепт на рассмотрении! ',

];