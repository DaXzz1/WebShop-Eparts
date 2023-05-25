<?php

return [
    "form" => [
        "required_info" => [
            "title" => "Обязательная информация",
            "description" => "Пожалуйста, заполните необходимую информацию для завершения Вашего заказа.",

            "shipping_address" => "Адрес доставки",

            "inputs" => [
                "firstname" => [
                    "label" => "Имя",
                    "placeholder" => "Введите Ваше имя",
                ],
                "lastname" => [
                    "label" => "Фамилия",
                    "placeholder" => "Введите Вашу фамилию",
                ],
                "email" => [
                    "label" => "Email",
                    "placeholder" => "Введите Ваш email",
                ],
                "phone" => [
                    "label" => "Телефон",
                    "placeholder" => "Введите Ваш телефон",
                ],
                "country" => [
                    "label" => "Страна",
                    "placeholder" => "Выберите страну",
                ],
                "city" => [
                    "label" => "Город",
                    "placeholder" => "Введите Ваш город",
                ],
                "state" => [
                    "label" => "Область",
                    "placeholder" => "Введите Вашу область",
                ],
                "address" => [
                    "label" => "Адрес",
                    "placeholder" => "Введите Ваш адрес",
                ],
                "address_2" => [
                    "label" => "Адрес 2",
                    "placeholder" => "Введите Ваш адрес 2",
                ],
                "zip" => [
                    "label" => "Почтовый индекс",
                    "placeholder" => "Введите Ваш почтовый индекс",
                ],
            ]
        ],
        "optional_info" => [
            "title" => "Дополнительная информация",
            "description" => "Если Вы хотите добавить больше информации, Вы можете сделать это здесь.",

            "inputs" => [
                "notes" => [
                    "label" => "Примечания",
                    "placeholder" => "Введите Ваши примечания...",
                ],
            ]
        ],
    ],
    "order" => [
        "list" => [
            "title" => "Ваш заказ",
            "description" => "Это сводка Вашего заказа. Вы можете удалить товары из корзины, нажав на кнопку с иконкой корзины.",

            "table" => [
                "product" => "Продукт",
                "total" => "Итого",

                "more_items" => [
                    "singular" => "+ :count товар",
                    "plural" => "+ :count товаров",
                ]
            ],
            "totals" => [
                "title" => "Всего",
                "subtotal" => [
                    "title" => "Промежуточный итог",
                    "taxes" => "Налоги уже включены",
                ],
                "shipping" => [
                    "title" => "Доставка",
                    "upon" => "При оформлении заказа",
                ],
                "total" => "Всего",
                "checkout" => "Перейти к оформлению заказа",
            ],
        ],
        "modal" => [
            'title' => 'Обзор заказа',
        ],
        "info" => [
            'title' => 'Информация о заказе',
            'description' => "Это информация о Вашем заказе. Пожалуйста, проверьте ее перед оформлением.",

            "shipping_cost" => [
                "title" => "Стоимость доставки",
                "free" => "Бесплатно",
            ],
            "approx_shipping_date" => "Дата доставки (приблизительно)",
            "total" => "Итого",

            "save_info" => "Сохранить информацию для следующего заказа",
            "pay" => "Оплатить",
            "terms_and_conditions" => "Нажимая на кнопку, Вы соглашаетесь с <a href=':url' class='text-primary link link-primary link-hover' target='_blank'>условиями использования</a>.",
        ]
    ],
    "success" => [
        "title" => "Спасибо за Ваш заказ, :name!",
        "description" => "Ваш заказ был успешно оформлен. Мы уведомим Вас по электронной почте, как только он будет отправлен.",
        "button" => "Вернуться на главную",
        "receipt" => "Посмотреть квитанцию",
        "my_orders" => "Мои заказы",
    ]
];