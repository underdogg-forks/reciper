<?php

return [

    // Action buttons
    'view' => 'Просмотреть',
    'delete' => 'Удалить',
    'edit' => 'Редактировать',
    'publish' => 'Опубликовать',
    'save' => 'Сохранить',
    'add_to_drafts' => 'В черновики',

    // User bubbles
    'likes_tip' => 'Сердца: :value<br>Здесь отображается общее количество сердечек со всех рецептах этого автора',
    'rating_tip' => 'Популярность: :value<br>В этом поле указаны очки популярности автора. Популярность составляется с нижеперечисленных данных:<br><br>1 сердечко = ' . config('custom.popularity_for_like') . ' очков<br>1 просмотр = ' . config('custom.popularity_for_view') . ' очков<br>1 добавление в избранные = ' . config('custom.popularity_for_favs') . ' очков',
    'views_tip' => 'Просмотры: :value<br>Это поле для отображения общего кол-ва просмотров со всех рецептов этого автора',

    // Other
    'remember_info' => 'Поставьте галочку если вы не хотите заполнять эту форму каждый раз когда хотите войти на свою страницу',

    // Recipes edit page
    'recipes_text' => 'Опишите процесс приготовления блюда по пунктам, используя кнопку Ввод (Enter) для отделения пунктов друг от друга.' . tip('Пример', '<br>После того как морковь почищена, натираем ее на терке (Enter)<br>В натертую морковь добавляем 1 чайную ложку соли, пол чайной ложки сахара и 3 капли уксуса.(Enter)<br>Мелко нарезанный лук обжариваем на растительном масле до мягкости.'),
    'recipes_ingredients' => 'Укажите все ингредиенты блюда. После каждого ингредиента нажимайте кнопку Ввод (Enter) чтобы разделить их на строки.' . tip('Пример', '<br>1 кг моркови (Нажимаем Enter)<br>1 маленькая луковица (Нажимаем Enter)<br>1 зубчик чеснока'),
    'recipes_intro' => 'В этом поле укажите краткое описание рецепта.' . tip('Пример', 'Вкусная морковь по-корейски за 10 минут которая готовится довольно просто. Морковь приправленная пряностями, будет отличной закуской на вашем столе.'),

];
