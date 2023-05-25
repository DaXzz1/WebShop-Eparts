<?php

return [
    'fields' => [
        'brand' => 'Bränd',
        'model' => 'Mudel',
        'start_production' => 'Tootmisaasta',
        'end_production' => 'Tootmislõpp',
        'code' => 'Tootekood',
        'manufacturer' => 'Tootja',
        'material' => 'Materjal',
        'color' => 'Värv',
        'location' => 'Asukoht',
        'price' => 'Hind',
        'details' => 'Detailid',
        'width' => 'Laius',
        'height' => 'Kõrgus',
        'length' => 'Pikkus',
        'engine' => [
            'code' => 'Mootori kood',
            'capacity' => 'Maht',
            'power' => 'Võimsus',
            'torque' => 'Pöördemoment',
            'injection' => 'Süstekülg',
            'cylinders' => 'Silindrite arv',
            'valves' => 'Kleebiste arv',
            'fuel' => 'Kütus',
            'consumption' => [
                'city' => 'Linnas',
                'highway' => 'Maanteel',
                'combined' => 'Keskmine',
            ]
        ],
        'transmission' => [
            'type' => 'Käigukast',
            'gears' => 'Käigud',
            'drive' => 'Vedu',
        ],
        'body' => [
            'weight' => 'Kaal',
            'clearance' => 'Maavara',
            'type' => 'Kere',
        ],
        'interior' => [
            'trunk' => 'Käru',
            'fuel_tank' => 'Kütusepaak',
            'seats' => 'Istekohti',
            'doors' => 'Uksi',
        ],
        'stock' => [
            'title' => 'Laos',
            'in_stock' => 'Laos',
            'items' => ':value tk.',
            'out_of_stock' => 'Otsas',
        ],
        'delivery' => 'Tarne aeg',
    ],
    'values' => [
        'engine' => [
            'capacity' => ':value cm<sup>3</sup> (:sub)',
            'power' => ':value kW',
            'torque' => ':value Nm',
            'cylinders' => ':value tk.',
            'valves' => ':value tk.',
            'injection' => [
                'mpfi' => 'Mitmepunktiline',
                'throttleBody' => 'Keeruka keha',
                'multiPointInjection' => 'Mitmepunktiline',
                'directInjection' => 'Otse',
                'portInjection' => 'Port',
                'sequentialInjection' => 'Järjestikune',
                'commonRailInjection' => 'Ühine raudtee',
                'dieselInjection' => 'Diisel',
                'hybridInjection' => 'Hübriid',
                'electricInjection' => 'Elekter',
            ],
            'fuel' => [
                'petrol' => 'Bensiin',
                'diesel' => 'Diisel',
                'gas' => 'Gaas',
                'hybrid' => 'Hübriid',
                'electric' => 'Elekter',
            ],
            'consumption' => [
                'city' => ':value l/100km',
                'highway' => ':value l/100km',
                'combined' => ':value l/100km',
            ],
        ],
        'transmission' => [
            'gears' => ':value käiku',
            'type' => [
                'automatic' => 'Automaatne',
                'manual' => 'Käsitsi',
                'semiAutomatic' => 'Poolautomaatne',
                'continuouslyVariable' => 'Vaike',
                'dualClutch' => 'Kahekordne klapid',
                'robotic' => 'Robotiseeritud',
            ],
            'drive' => [
                'short' => [
                    'front' => 'Eesmine',
                    'rear' => 'Tagumine',
                    'full' => 'Kõik',
                ],
                'full' => [
                    'front' => 'Eesmine vedu',
                    'rear' => 'Tagumine vedu',
                    'full' => 'Kõik vedu',
                ],
            ],
        ],
        'body' => [
            'weight' => ':value kg',
            'clearance' => ':value mm',
        ],
        'interior' => [
            'trunk' => ':value l',
            'fuel_tank' => ':value l',
            'seats' => ':value kohta',
            'doors' => ':value uksi',
        ],
        'colors' => [
            'black' => 'Must',
            'white' => 'Valge',
            'silver' => 'Hõbe',
            'gray' => 'Hall',
            'red' => 'Punane',
            'blue' => 'Sinine',
            'green' => 'Roheline',
            'yellow' => 'Kollane',
            'brown' => 'Pruun',
            'orange' => 'Oranž',
            'purple' => 'Lilla',
            'pink' => 'Roosa',
            'gold' => 'Kuldne',
            'beige' => 'Bež',
            'other' => 'Muu',
            'unknown' => 'Tundmatu',
        ],
        'location' => [
            'front' => 'Ees',
            'back' => 'Taga',
            'left' => 'Vasakul',
            'right' => 'Paremal',
            'top' => 'Üleval',
            'bottom' => 'All',
            'both' => 'Mõlemad',
            'unknown' => 'Tundmatu',
        ],
        'width' => ':value mm',
        'height' => ':value mm',
        'length' => ':value mm',
        'material' => [
            'steel' => 'Teras',
            'aluminium' => 'Alumiinium',
            'plastic' => 'Plastik',
            'glass' => 'Klaas',
        ],
    ],
    'filters' => [
        'manufacturer' => [
            'title' => 'Tootja',
            'all' => 'Kõik',
        ],
        'colors' => [
            'title' => 'Värv',
            'all' => 'Kõik',
        ],
        'location' => [
            'title' => 'Asukoht',
            'all' => 'Kõik',
        ],
        'sort_by' => [
            'title' => 'Sorteeri',
            'methods' => [
                'nameAsc' => 'Nime järgi kasvavalt',
                'nameDesc' => 'Nime järgi kahanevalt',
                'priceAsc' => 'Hinna järgi kasvavalt',
                'priceDesc' => 'Hinna järgi kahanevalt',
            ]
        ],
        'price' => [
            'title' => 'Hind',
            'from' => 'Alates',
            'to' => 'Kuni',
        ],
        'search' => 'Otsi',
        'reset' => 'Lähtesta',
    ],
    'list' => [
        'result_count' => [
            'found' => 'Leitud',
            'count' => 'toode|toodet|tooteid',
        ],
    ],
    'categories' => [
        'title' => 'Teised kategooriad',
    ],
];