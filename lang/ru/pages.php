<?php

return [
    'home' => [
        'title' => 'Главная страница',
        'breadcrumb' => 'Главная страница',
        "content" => [
            'title' => 'Список машин',
            'description' => 'Список всех машин, которые есть в нашем каталоге.',
        ]
    ],
    'cart' => [
        'title' => 'Моя корзина',
        'breadcrumb' => 'Моя корзина',

        'content' => [
            'title' => 'Моя корзина',
            'description' => 'Список всех товаров в Вашей корзине.',

            'modal' => [
                'clear' => [
                    'title' => 'Очистить корзину',
                    'description' => 'Вы уверены, что хотите очистить корзину? Все товары будут удалены.',

                    'actions' => [
                        'confirm' => 'Очистить',
                        'cancel' => 'Отмена',
                    ]
                ]
            ]
        ]
    ],
    'models' => [
        'title' => 'Модели :brand',
        'breadcrumb' => ':brand',
        'content' => [
            'title' => 'Список моделей :brand',
            'description' => 'Список всех моделей :brand, которые есть в нашем каталоге.',

            'card' => [
                'total_parts' => 'Всего запчастей: :count',
                'empty' => 'Нет запчастей',
            ],

            'search' => [
                'placeholder' => 'Поиск моделей :brand...',
                'submit' => 'Поиск',
            ]
        ]
    ],
    'partCategories' => [
        'title' => 'Категории запчастей для :brand :model',
        'breadcrumb' => 'Категории для :brand :model',
        'breadcrumb_with_modification' => 'Категории для :brand :model (:engine, #:engine_code, :transmission, :transmission_drive)',
        'content' => [
            'title' => 'Список категорий для :brand :model',
            'description' => 'Список всех категорий для :brand :model, которые есть в нашем каталоге.',

            'search' => [
                'placeholder' => 'Поиск категорий для :brand :model...',
                'submit' => 'Поиск',
            ],
            "card" => [
                "base_info" => "Основная информация",
                "specifications" => [
                    "title" => "Характеристики",
                    "engine" => "Двигатель",
                    "transmission" => "Коробка передач",
                    "body" => "Кузов",
                    "interior" => "Интерьер",
                ]
            ],
            "modification" => [
                "select" => [
                    "title" => "Выберите модификацию",
                    "option" => [
                        "title" => "Модификация не выбрана",
                        "description" => ":engineCapacity (:engineCode), :enginePower л.с., :transmissionDrive (:gears)"
                    ],
                    "none" => "Очистить",
                    "value" => ":capacity (:drive) "
                ]
            ],
        ]
    ],
    'parts' => [
        'title' => 'Запчасти для :brand :model',
        'breadcrumb' => 'Запчасти для :brand :model',
        'content' => [
            'title' => [
                'found' => "Найдена|Найдено|Найдено",
                'parts' => "запчасть|запчасти|запчастей",
            ],
            'description' => 'Список всех запчастей для :brand :model, которые есть в нашем каталоге.',

            'search' => [
                'placeholder' => 'Поиск запчастей для :brand :model...',
                'submit' => 'Поиск',
            ],

            'empty' => [
                'title' => 'Ничего не найдено',
                'description' => 'По Вашему запросу ничего не найдено.',
            ],
        ]
    ],
    'partDetails' => [
        'title' => 'Запчасть #:part_number',
        'breadcrumb' => 'Запчасть #:part_number',

        'content' => [
            'may_be_interested' => [
                'title' => 'Возможно, Вас заинтересует',

                'empty' => [
                    'title' => "Пока пусто",
                    'description' => 'К сожалению, пока мы не можем предложить Вам товары.',
                ],
            ]
        ]
    ],
    'my_profile' => [
        'title' => 'Мой профиль',
        'breadcrumb' => 'Мой профиль',

        'content' => [
            'nav' => [
                'profile' => 'Профиль',
                'orders' => 'Заказы',
            ],

            'form' => [
                'title' => 'Профиль',
                'description' => 'Здесь Вы можете изменить свои персональные данные.',
                'submit' => 'Сохранить',
                'reset' => 'Сбросить',

                'personal_data' => 'Персональные данные',

                'firstName' => [
                    'label' => 'Имя',
                    'placeholder' => 'Введите имя',
                ],
                'lastName' => [
                    'label' => 'Фамилия',
                    'placeholder' => 'Введите фамилию',
                ],
                'email' => [
                    'label' => 'Email',
                    'placeholder' => 'Введите email',
                ],
                'phone' => [
                    'label' => 'Телефон',
                    'placeholder' => 'Введите телефон',
                ],
                'password' => [
                    'label' => 'Пароль',
                    'placeholder' => 'Введите пароль',
                ],
                'password_confirmation' => [
                    'label' => 'Подтверждение пароля',
                    'placeholder' => 'Подтвердите пароль',
                ],

                'address' => [
                    'title' => 'Адресная информация',
                    'label' => 'Адрес',
                    'placeholder' => 'Введите адрес',
                ],
                'country' => [
                    'label' => 'Страна',
                    'placeholder' => 'Выберите страну',
                ],
                'city' => [
                    'label' => 'Город',
                    'placeholder' => 'Введите город',
                ],
                'zipCode' => [
                    'label' => 'Индекс',
                    'placeholder' => 'Введите индекс',
                ],
                'avatar' => [
                    'label' => 'Аватар',
                ],
                'avatar_preview' => 'Предпросмотр',
            ]
        ]
    ],
    "my_orders" => [
        "title" => "Мои заказы",
        "breadcrumb" => "Мои заказы",
        'content' => [
            'title' => 'Список заказов',
            'description' => 'Список всех заказов, которые Вы сделали в нашем интернет-магазине.',
            'delete_all' => 'Удалить все заказы',

            'empty' => [
                'title' => 'Заказов нет',
                'description' => 'У Вас нет заказов. Вы можете сделать заказ, перейдя на страницу <a href=":url" class="link link-primary">с моделями авто</a>.',
            ],

            'table' => [
                'bought_at' => 'Дата покупки',
                'status' => 'Статус',
                'amount' => 'Сумма',

                'statuses' => [
                    'paid' => 'Оплачен',
                    'unpaid' => 'Не оплачен',
                ],

                'actions' => [
                    'title' => 'Действия',
                    'view' => 'Просмотреть',
                    'delete' => 'Удалить',
                ]
            ],

            'modal' => [
                'title' => 'Заказ #:order_number',
                'close' => 'Закрыть',

                'empty' => [
                    'title' => 'Ничего не найдено',
                    'description' => 'Товаров в этом заказе не найдено.',
                ],
                'delete' => [
                    'title' => 'Удаление заказа #:order_number',
                    'description' => 'Вы действительно хотите удалить заказ #:order_number?',

                    'actions' => [
                        'cancel' => 'Отмена',
                        'confirm' => 'Удалить',
                    ]
                ],

                'delete_all' => [
                    'title' => 'Удаление всех заказов',
                    'description' => 'Вы действительно хотите удалить все заказы?',

                    'actions' => [
                        'cancel' => 'Отмена',
                        'confirm' => 'Удалить',
                    ]
                ]
            ],

            'deleted' => [
                'title' => 'Заказ удален',
                'message' => 'Заказ #:id был успешно удален.',
            ],
        ]
    ],
    'global_search' => [
        'title' => 'Поиск',
        'breadcrumb' => 'Поиск',

        'content' => [
            'title' => 'Глобальный поиск',
            'description' => 'Здесь Вы можете искать автомобили, модели и запчасти по всему нашему каталогу.',

            'form' => [
                'placeholder' => 'Введите запрос для поиска',
                'press_enter' => 'Нажмите <kbd>Enter</kbd> для поиска',
                'search' => 'Поиск',
            ],

            'list' => [
                'cars' => 'Автомобили',
                'models' => 'Модели',
                'parts' => 'Запчасти',

                'start_search' => [
                    'title' => 'Начните поиск',
                    'description' => 'Введите запрос для поиска в поле выше.',
                ]
            ]
        ]
    ],
    'stripe' => [
        "title" => "Оплата заказа",
        "breadcrumb" => "Оплата заказа",
    ],
    '404' => [
        'title' => 'Ошибка 404',

        'content' => [
            'title' => 'Упс!',
            'description' => 'Похоже, что такой страницы не существует.',
            'back_to_home' => 'Вернуться на главную',
        ]
    ]
];
