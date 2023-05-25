<?php

return [
    "form" => [
        "required_info" => [
            "title" => "Kohustuslik info",
            "description" => "Palun täitke vajalik info oma tellimuse lõpetamiseks.",

            "shipping_address" => "Kohaletoimetamise aadress",

            "inputs" => [
                "firstname" => [
                    "label" => "Eesnimi",
                    "placeholder" => "Sisestage oma eesnimi",
                ],
                "lastname" => [
                    "label" => "Perekonnanimi",
                    "placeholder" => "Sisestage oma perekonnanimi",
                ],
                "email" => [
                    "label" => "E-post",
                    "placeholder" => "Sisestage oma e-posti aadress",
                ],
                "phone" => [
                    "label" => "Telefon",
                    "placeholder" => "Sisestage oma telefoninumber",
                ],
                "country" => [
                    "label" => "Riik",
                    "placeholder" => "Valige oma riik",
                ],
                "city" => [
                    "label" => "Linn",
                    "placeholder" => "Sisestage oma linn",
                ],
                'state' => [
                    'label' => 'Piiirkond',
                    'placeholder' => 'Sisestage oma piiirkond',
                ],
                "address" => [
                    "label" => "Aadress",
                    "placeholder" => "Sisestage oma aadress",
                ],
                "address_2" => [
                    'label' => 'Aadress 2',
                    'placeholder' => 'Sisestage oma aadress 2',
                ],
                "zip" => [
                    "label" => "Postiindeks",
                    "placeholder" => "Sisestage oma postiindeks",
                ],
            ]
        ],
        "optional_info" => [
            "title" => "Valikuline teave",
            "description" => "Kui soovite lisada rohkem teavet, saate seda teha siin.",

            "inputs" => [
                "notes" => [
                    "label" => "Märkused",
                    "placeholder" => "Sisestage oma märkused ...",
                ],
            ]
        ]
    ],
    "order" => [
        "list" => [
            "title" => "Teie tellimus",
            "description" => "See on teie tellimuse kokkuvõte. Kaubad saate ostukorvist eemaldada, vajutades ostukorvi ikooniga nupule.",

            "table" => [
                "product" => "Toode",
                "total" => "Kokku",

                "more_items" => [
                    "singular" => "+ :count toode",
                    "plural" => "+ :count toodet",
                ]
            ],
            "totals" => [
                "title" => "Kokku",
                "subtotal" => [
                    "title" => "Vahesumma",
                    "taxes" => "Maksud on juba sisaldatud",
                ],
                "shipping" => [
                    "title" => "Kohaletoimetamine",
                    "upon" => "Tellimuse esitamisel",
                ],
                "total" => "Kokku",
                "checkout" => "Mine tellimuse esitamiseks",
            ],
        ],
        "modal" => [
            "title" => "Tellimuse ülevaade"
        ],
        "info" => [
            'title' => 'Tellimuse info',
            'description' => "See on teie tellimuse info. Palun kontrollige seda enne tellimuse esitamist.",

            "shipping_cost" => [
                "title" => "Kohaletoimetamise maksumus",
                "free" => "Tasuta",
            ],
            "approx_shipping_date" => "Kohaletoimetamise kuupäev (ligikaudu)",
            "total" => "Kokku",

            'save_info' => "Salvestage info järgmiseks tellimuseks",
            "pay" => "Maksta",
            "terms_and_conditions" => "Nuppu klõpsates nõustute <a href=':url' class='text-primary link link-primary link-hover' target='_blank'> kasutustingimustega </a>.",
        ]
    ],
    'success' => [
        'title' => 'Täname teie tellimuse eest, :name!',
        'description' => 'Teie tellimus on edukalt esitatud. Teavitame teid e-posti teel, kui see on saadetud.',
        'button' => 'Tagasi pealehele',
        'receipt' => 'Vaata arvet',
        'my_orders' => 'Minu tellimused',
    ],
];
