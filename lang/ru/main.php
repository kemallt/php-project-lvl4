<?php

return [
    'app' => [
        'title' => 'Менеджер задач',
        'statuses' => 'Статусы',
        'tasks' => 'Задачи',
        'labels' => 'Метки',
        'hexlet_greetings' => 'Привет от Хекслета!',
        'description' => 'Это простой менеджер задач на Laravel',
        'press_me' => ' Нажми меня ',
    ],
    'statuses' => [
        'create' => 'Создать статус',
        'id' => 'ID',
        'name' => 'Имя',
        'created_at' => 'Дата создания',
        'delete' => 'Удалить',
        'edit' => 'Изменить',
        'update' => 'Обновить',
        'store' => 'Создать',
        'actions' => 'Действия',
        'create_status' => 'Создать статус',
    ],
    'statuses_seed' => [
        'new' => 'новый',
        'in_work' => 'в работе',
        'testing' => 'на тестировании',
        'completed' => 'завершен',
    ],
    'flashes' => [
        'cannot_add_status' => 'Не удалось добавить статус',
        'cannot_upate_status' => 'Не удалось обновить статус',
        'status_added' => 'Статус успешно создан',
        'status_deleted' => 'Статус успешно удален',
        'status_changed' => 'Статус успешно изменен',
        'status_has_tasks' => 'Не удалось удалить статус'
    ],
    'tasks' => [
        'create' => 'Создать задачу',
        'id' => 'ID',
        'name' => 'Имя',
        'created_at' => 'Дата создания',
        'edit' => 'Изменить',
        'update' => 'Обновить',
        'store' => 'Создать',
        'action' => 'Действия',
        'author' => 'Автор',
        'doer' => 'Исполнитель',
        'status' => 'Статус',
    ],
];
