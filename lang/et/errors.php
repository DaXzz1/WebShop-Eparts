<?php

return [
//    "api" => [
//        "search" => [
//            "title" => "Нам очень жаль, но ничего не найдено :(",
//            "models" => [
//                "title" => 'Мы не нашли моделей для машины ":car" с запросом: ":query".',
//            ],
//            'parts' => [
//                'title' => 'По запросу ":query" ничего не найдено.',
//                'with_filters' => 'Мы не смогли найти запчасти с заданными фильтрами. Попробуйте сбросить фильтры.',
//            ]
//        ],
//        "global_search" => [
//            "title" => "Нам очень жаль, но ничего не найдено :(",
//            "description" => 'Мы не смогли ничего найти с запросом: ":query".',
//        ]
//    ],
//    "partCategories" => [
//        "title" => "Упс! Ничего не найдено :(",
//        "description" => "К сожалению, мы не нашли ни одной категории для <b>:car</b>.",
//        "back" => "Назад к списку машин :brand",
//    ],

    'api' => [
        'search' => [
            'title' => 'Vabandame, aga midagi ei leitud :(',
            'models' => [
                'title' => 'Me ei leidnud mudelit autole ":car" päringuga: ":query".',
            ],
            'parts' => [
                'title' => 'Päringuga ":query" midagi ei leitud.',
                'with_filters' => 'Me ei suutnud leida osi määratud filtritega. Proovige filtreid tühjendada.',
            ]
        ],
        'global_search' => [
            'title' => 'Vabandame, aga midagi ei leitud :(',
            'description' => 'Me ei suutnud leida midagi päringuga: ":query".',
        ]
    ],
    'partCategories' => [
        'title' => 'Ups! Midagi ei leitud :(',
        'description' => 'Kahjuks ei leidnud me ühtegi kategooriat <b>:car</b>.',
        'back' => 'Tagasi :brand autode nimekirja',
    ],
];

