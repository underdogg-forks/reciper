<?php

return [
    // Views
    'visitors' => 'Посетители',
    'visitor' => 'Посетитель',
    'all_views' => 'Все просмотры',
    'all_visitors' => 'Все посетители',
    'ban' => 'Заблокировать',
    'unban' => 'Разблокировать',
    'gave_likes' => 'Поставленно лайков',
    'recipes_viewed' => 'Просмотренно рецептов',
    'registered_users' => 'Зарегистрированные пользователи',
    'not_registered_users' => 'Не зарегистрированные пользователи',
    'banned_users' => 'Заблокированные пользователи',
    'what_reason_to_ban' => 'Укажите причину по которой посетитетелю будет закрыт доступ, и кол-во дней в течении которых у пользователя не будет доступа к сайту',
    'days' => 'Дни',
    'first_visit' => 'Первый везит',
    'days_with_us' => 'Дней с момента первого визита',
    'last_activity' => 'Последняя активность',
    'are_you_sure_to_ban' => 'Вы уверены что хотите заблокировать этого посетителя?',
    'are_you_sure_to_unban' => 'Вы уверены что хотите блокировать этого посетителя?',

    // Controller
    'visitor_banned' => 'Посетитель был заблокирован. Колличество дней на которые посетитель заблокирован: :days',
    'visitor_unbanned' => 'Посетитель разблокирован',
    'visitor_already_banned' => 'Вы не можете заблокировать этого посетителя так как он уже заблокирован',

    // Validation
    'days_required' => 'Укажите колличество дней на которые вы хотите заблокировать посетителя',
    'days_numeric' => 'Дни нужно указать числами',
    'message_required' => 'Поле для ввода сообщения обязательно к заполнению',
    'message_min' => 'Сообщение не должно быть меньше :min символов',
    'message_max' => 'Сообщение не должно превышать :max символов',
];
