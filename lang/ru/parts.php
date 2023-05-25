<?php

return [
    "fields" => [
        "brand" => "Бренд",
        "model" => "Модель",
        "start_production" => "Начало производства",
        "end_production" => "Конец производства",
        "code" => "Код продукта",
        "manufacturer" => "Производитель",
        'material' => 'Материал',
        "color" => "Цвет",
        "location" => "Расположение",
        "price" => "Цена",
        "details" => "Подробнее",
        'width' => 'Ширина',
        'height' => 'Высота',
        'length' => 'Длина',
        "engine" => [
            "code" => "Код двигателя",
            "capacity" => "Объём",
            "power" => "Мощность",
            "torque" => "Крутящий момент",
            "injection" => "Тип инжекции",
            "cylinders" => "Количество цилиндров",
            "valves" => "Количество клапанов",
            "fuel" => "Тип топлива",
            "consumption" => [
                "city" => "Расход в городе",
                "highway" => "Расход на трассе",
                "combined" => "Средний расход",
            ],
        ],
        "transmission" => [
            "type" => "Тип",
            "gears" => "Количество передач",
            "drive" => "Привод",
        ],
        "body" => [
            "weight" => "Вес",
            "clearance" => "Клиренс",
            'type' => 'Тип кузова',
        ],
        "interior" => [
            "trunk" => "Объём багажника",
            "fuel_tank" => "Объём топливного бака",
            "seats" => "Количество мест",
            "doors" => "Количество дверей",
        ],
        "stock" => [
            "title" => "Наличие",
            "in_stock" => "В наличии",
            "items" => ":value шт.",
            "out_of_stock" => "Нет в наличии",
        ],
        "delivery" => "Дата доставки",
    ],
    "values" => [
        "engine" => [
            "capacity" => ":value см<sup>3</sup> (:sub)",
            "power" => ":value л.с.",
            "torque" => ":value Нм",
            "cylinders" => ":value шт.",
            "valves" => ":value шт.",
            "injection" => [
                "mpfi" => "Многоточечный",
                "throttleBody" => "Тело ГБЦ",
                "multiPointInjection" => "Многоточечный",
                "directInjection" => "Непосредственный",
                "portInjection" => "Портовый",
                "sequentialInjection" => "Последовательный",
                "commonRailInjection" => "Общий рейл",
                "dieselInjection" => "Дизельный",
                "hybridInjection" => "Гибридный",
                "electricInjection" => "Электрический",
            ],
            "fuel" => [
                "petrol" => "Бензин",
                "diesel" => "Дизель",
                "gas" => "Газ",
                "hybrid" => "Гибрид",
                "electric" => "Электро",
            ],
            "consumption" => [
                "city" => ":value л/100км",
                "highway" => ":value л/100км",
                "combined" => ":value л/100км",
            ],
        ],
        "transmission" => [
            "gears" => ":value передач",
            "type" => [
                "automatic" => "Автоматическая",
                "manual" => "Механическая",
                "semiAutomatic" => "Полуавтоматическая",
                "continuouslyVariable" => "Вариатор",
                "dualClutch" => "Двойное сцепление",
                "robotic" => "Роботизированная",
            ],
            "drive" => [
                "short" => [
                    "front" => "Передний",
                    "rear" => "Задний",
                    "full" => "Полный",
                ],
                "full" => [
                    "front" => "Передний привод",
                    "rear" => "Задний привод",
                    "full" => "Полный привод",
                ],
            ],
        ],
        "body" => [
            "weight" => ":value кг",
            "clearance" => ":value мм",
        ],
        "interior" => [
            "trunk" => ":value л",
            "fuel_tank" => ":value л",
            "seats" => ":value мест",
            "doors" => ":value дверей",
        ],
        "colors" => [
            "black" => "Чёрный",
            "white" => "Белый",
            "silver" => "Серебристый",
            "gray" => "Серый",
            "red" => "Красный",
            "blue" => "Синий",
            "green" => "Зелёный",
            "yellow" => "Жёлтый",
            "brown" => "Коричневый",
            "orange" => "Оранжевый",
            "purple" => "Фиолетовый",
            "pink" => "Розовый",
            "gold" => "Золотой",
            "beige" => "Бежевый",
            "unknown" => "Неизвестный"
        ],
        "location" => [
            "front" => "Спереди",
            "back" => "Сзади",
            "left" => "Слева",
            "right" => "Справа",
            "top" => "Сверху",
            "bottom" => "Снизу",
            "both" => "С обеих сторон",
            "unknown" => "Неизвестно"
        ],
        'width' => ':value мм',
        'height' => ':value мм',
        'length' => ':value мм',
        'material' => [
            'steel' => 'Сталь',
            'aluminium' => 'Алюминий',
            'plastic' => 'Пластик',
            'glass' => 'Стекло',
        ],
    ],
    "filters" => [
        "manufacturer" => [
            "title" => "Производитель",
            "all" => "Все",
        ],
        "colors" => [
            "title" => "Цвет",
            "all" => "Все",
        ],
        "location" => [
            "title" => "Расположение",
            "all" => "Все",
        ],
        "sort_by" => [
            "title" => "Сортировать по",
            "methods" => [
                "nameAsc" => "Название по возрастанию",
                "nameDesc" => "Название по убыванию",
                "priceAsc" => "Цена по возрастанию",
                "priceDesc" => "Цена по убыванию",
            ]
        ],
        "price" => [
            "title" => "Цена",
            "from" => "От",
            "to" => "До",
        ],
        "search" => "Поиск",
        "reset" => "Сбросить",
    ],
    "list" => [
        "result_count" => [
            "found" => "Найден|Найдено|Найдено",
            "count" => "товар|товара|товаров",
        ]
    ],
    "categories" => [
        "title" => "Другие категории",
    ]
];
