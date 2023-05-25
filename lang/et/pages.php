<?php

return [
    'home' => [
        'title' => 'Avaleht',
        'breadcrumb' => 'Avaleht',
        "content" => [
            'title' => 'Autode nimekiri',
            'description' => 'Autode nimekiri, mis on meie kataloogis.',
        ]
    ],
    'cart' => [
        'title' => 'Minu ostukorv',
        'breadcrumb' => 'Minu ostukorv',

        'content' => [
            'title' => 'Minu ostukorv',
            'description' => 'Ostukorvi sisu.',

            'modal' => [
                'clear' => [
                    'title' => 'Tühjenda ostukorv',
                    'description' => 'Oled sa kindel, et soovid ostukorvi tühjendada? Kõik tooted kustutatakse.',

                    'actions' => [
                        'confirm' => 'Tühjenda',
                        'cancel' => 'Tühista',
                    ]
                ]
            ]
        ]
    ],
    'models' => [
        'title' => 'Autode nimekiri :brand',
        'breadcrumb' => ':brand',
        'content' => [
            'title' => 'Autode nimekiri :brand',
            'description' => 'Autode nimekiri :brand, mis on meie kataloogis.',

            'card' => [
                'total_parts' => 'Kokku varuosasid: :count',
                'empty' => 'Varuosi pole',
            ],

            'search' => [
                'placeholder' => 'Otsi autode nimekirjast :brand...',
                'submit' => 'Otsi',
            ]
        ]
    ],
    'partCategories' => [
        'title' => 'Kategooriad :brand :model',
        'breadcrumb' => 'Kategooriad :brand :model',
        'breadcrumb_with_modification' => 'Kategooriad :brand :model (:engine, #:engine_code, :transmission, :transmission_drive)',
        'content' => [
            'title' => 'Kategooriad :brand :model',
            'description' => 'Kategooriad :brand :model, mis on meie kataloogis.',

            'search' => [
                'placeholder' => 'Otsi kategooriaid :brand :model...',
                'submit' => 'Otsi',
            ],
            "card" => [
                "base_info" => "Põhiteave",
                "specifications" => [
                    "title" => "Spetsifikatsioonid",
                    "engine" => "Mootor",
                    "transmission" => "Käigukast",
                    "body" => "Kere",
                    "interior" => "Sisustus",
                ]
            ],
            "modification" => [
                "select" => [
                    "title" => "Vali mudel",
                    "option" => [
                        "title" => "Mudel pole valitud",
                        "description" => ":engineCapacity (:engineCode), :enginePower kW, :transmissionDrive (:gears)"
                    ],
                    "none" => "Tühista",
                    "value" => ":capacity (:drive) "
                ]
            ],
        ]
    ],
    'parts' => [
        'title' => 'Varuosad :brand :model',
        'breadcrumb' => 'Varuosad :brand :model',

        'content' => [
            'title' => [
                'found' => "Leitud|Leitud|Leitud",
                'parts' => "varuosa|varuosad|varuosasid",
            ],
            'description' => 'Varuosade nimekiri :brand :model, mis on meie kataloogis.',

            'search' => [
                'placeholder' => 'Otsi varuosasid :brand :model...',
                'submit' => 'Otsi',
            ],

            'empty' => [
                'title' => 'Midagi ei leitud',
                'description' => 'Teie päringule ei leitud midagi.',
            ],
        ]
    ],
    'partDetails' => [
        'title' => 'Varuosa #:part_number',
        'breadcrumb' => 'Varuosa #:part_number',

        'content' => [
            'may_be_interested' => [
                'title' => 'Võib-olla olete huvitatud',

                'empty' => [
                    'title' => 'Kuni see on tühi',
                    'description' => 'Kahjuks ei saa me teile tooteid pakkuda.',
                ],
            ]
        ]
    ],
    'my_profile' => [
        'title' => 'Minu profiil',
        'breadcrumb' => 'Minu profiil',

        'content' => [
            'nav' => [
                'profile' => 'Profiil',
                'orders' => 'Tellimused',
            ],

            'form' => [
                'title' => 'Profiil',
                'description' => 'Siin saate muuta oma isiklikke andmeid.',
                'submit' => 'Salvesta',
                'reset' => 'Tühista',

                'personal_data' => 'Isiklikud andmed',

                'firstName' => [
                    'label' => 'Eesnimi',
                    'placeholder' => 'Sisestage eesnimi',
                ],
                'lastName' => [
                    'label' => 'Perekonnanimi',
                    'placeholder' => 'Sisestage perekonnanimi',
                ],
                'email' => [
                    'label' => 'Email',
                    'placeholder' => 'Sisestage email',
                ],
                'phone' => [
                    'label' => 'Telefon',
                    'placeholder' => 'Sisestage telefon',
                ],
                'password' => [
                    'label' => 'Parool',
                    'placeholder' => 'Sisestage parool',
                ],
                'password_confirmation' => [
                    'label' => 'Parooli kinnitus',
                    'placeholder' => 'Kinnitage parool',
                ],

                'address' => [
                    'title' => 'Aadressi info',
                    'label' => 'Aadress',
                    'placeholder' => 'Sisestage aadress',
                ],
                'country' => [
                    'label' => 'Riik',
                    'placeholder' => 'Valige riik',
                ],
                'city' => [
                    'label' => 'Linn',
                    'placeholder' => 'Sisestage linn',
                ],
                'zipCode' => [
                    'label' => 'Indeks',
                    'placeholder' => 'Sisestage indeks',
                ],
                'avatar' => [
                    'label' => 'Avatar',
                ],
                'avatar_preview' => 'Eelvaade',
            ]
        ]
    ],
    'my_orders' => [
        'title' => 'Minu tellimused',
        'breadcrumb' => 'Minu tellimused',

        'content' => [
            'title' => 'Tellimuste nimekiri',
            'description' => 'Kõik tellimused, mida olete meie veebipoes teinud.',
            'delete_all' => 'Kustuta kõik tellimused',

            'empty' => [
                'title' => 'Tellimusi pole',
                'description' => 'Teil pole tellimusi. Saate tellida, minnes lehele <a href=":url" class="link link-primary">autode mudelitega</a>.',
            ],

            'table' => [
                'bought_at' => 'Ostu kuupäev',
                'status' => 'Staatus',
                'amount' => 'Summa',

                'statuses' => [
                    'paid' => 'Makstud',
                    'unpaid' => 'Maksmata',
                ],

                'actions' => [
                    'title' => 'Tegevused',
                    'view' => 'Vaata',
                    'delete' => 'Kustuta',
                ]
            ],

            'modal' => [
                'title' => 'Tellimus #:order_number',
                'close' => 'Sulge',

                'empty' => [
                    'title' => 'Midagi ei leitud',
                    'description' => 'Selles tellimuses ei leitud tooteid.',
                ],

                'delete' => [
                    'title' => 'Tellimuse #:order_number kustutamine',
                    'description' => 'Kas soovite kindlasti tellimuse #:order_number kustutada?',

                    'actions' => [
                        'cancel' => 'Tühista',
                        'confirm' => 'Kustuta',
                    ]
                ],

                'delete_all' => [
                    'title' => 'Kõikide tellimuste kustutamine',
                    'description' => 'Kas soovite kindlasti kõik tellimused kustutada?',

                    'actions' => [
                        'cancel' => 'Tühista',
                        'confirm' => 'Kustuta',
                    ]
                ]
            ],

            'deleted' => [
                'title' => 'Tellimus kustutatud',
                'message' => 'Tellimus #:id on edukalt kustutatud.',
            ],
        ]
    ],
    'global_search' => [
        'title' => 'Otsing',
        'breadcrumb' => 'Otsing',

        'content' => [
            'title' => 'Globaalne otsing',
            'description' => 'Siin saate otsida autosid, mudeleid ja varuosi kogu meie kataloogist.',

            'form' => [
                'placeholder' => 'Sisestage otsingupäring',
                'press_enter' => 'Vajutage otsimiseks <kbd>Enter</kbd>',
                'search' => 'Otsi',
            ],

            'list' => [
                'cars' => 'Autod',
                'models' => 'Mudelid',
                'parts' => 'Osalised',

                'start_search' => [
                    'title' => 'Alusta otsingut',
                    'description' => 'Sisestage otsingupäring eespool olevasse välja.',
                ]
            ]
        ]
    ],
    'stripe' => [
        "title" => "Tellimuse maksmine",
        "breadcrumb" => "Tellimuse maksmine",
    ],
    '404' => [
        'title' => 'Viga 404',

        'content' => [
            'title' => 'Ups!',
            'description' => 'Vabandame, kuid sellist lehte ei eksisteeri.',
            'back_to_home' => 'Tagasi avalehele',
        ]
    ]
];
