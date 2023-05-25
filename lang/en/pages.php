<?php

return [
    'home' => [
        'title' => 'Home',
        'breadcrumb' => 'Home',

        'content' => [
            'title' => 'List of cars',
            'description' => 'List of all cars that are in our catalog.',
        ]
    ],
    'cart' => [
        'title' => 'My cart',
        'breadcrumb' => 'My cart',

        'content' => [
            'title' => 'My cart',
            'description' => 'List of all products in your cart.',

            'modal' => [
                'clear' => [
                    'title' => 'Clear cart',
                    'description' => 'Are you sure you want to clear the cart? All products will be deleted.',

                    'actions' => [
                        'confirm' => 'Clear',
                        'cancel' => 'Cancel',
                    ]
                ]
            ]
        ]
    ],
    'models' => [
        'title' => 'Models :brand',
        'breadcrumb' => ':brand',
        'content' => [
            'title' => 'List of models :brand',
            'description' => 'List of all models :brand, which are in our catalog.',

            'card' => [
                'total_parts' => 'Total parts: :count',
                'empty' => 'No parts',
            ],

            'search' => [
                'placeholder' => 'Search models :brand...',
                'submit' => 'Search',
            ]
        ]
    ],
    'partCategories' => [
        'title' => 'Part categories for :brand :model',
        'breadcrumb' => 'Categories for :brand :model',
        'breadcrumb_with_modification' => 'Categories for :brand :model (:engine, #:engine_code, :transmission, :transmission_drive)',
        'content' => [
            'title' => 'List of categories for :brand :model',
            'description' => 'List of all categories for :brand :model, which are in our catalog.',

            'search' => [
                'placeholder' => 'Search categories for :brand :model...',
                'submit' => 'Search',
            ],
            "card" => [
                "base_info" => "Base information",
                "specifications" => [
                    "title" => "Specifications",
                    "engine" => "Engine",
                    "transmission" => "Transmission",
                    "body" => "Body",
                    "interior" => "Interior",
                ]
            ],
            "modification" => [
                "select" => [
                    "title" => "Select modification",
                    "option" => [
                        "title" => "Modification not selected",
                        "description" => ":engineCapacity (:engineCode), :enginePower hp, :transmissionDrive (:gears)"
                    ],
                    "none" => "Clear",
                    "value" => ":capacity (:drive) "
                ]
            ],
        ]
    ],
    'parts' => [
        'title' => 'Parts for :brand :model',
        'breadcrumb' => 'Parts for :brand :model',
        'content' => [
            'title' => [
                'found' => "Found|Found|Found",
                'parts' => "part|parts|parts",
            ],
            'description' => 'List of all parts for :brand :model, which are in our catalog.',

            'search' => [
                'placeholder' => 'Search parts for :brand :model...',
                'submit' => 'Search',
            ],

            'empty' => [
                'title' => 'Nothing found',
                'description' => 'Nothing found for your request.',
            ],
        ]
    ],
    'partDetails' => [
        'title' => 'Part #:part_number',
        'breadcrumb' => 'Part :part_number',

        'content' => [
            'may_be_interested' => [
                'title' => 'You may be interested',

                'empty' => [
                    'title' => "As long as it's empty",
                    'description' => 'Unfortunately, we can not offer you products yet.',
                ],
            ]
        ]
    ],
    'my_profile' => [
        'title' => 'My profile',
        'breadcrumb' => 'My profile',

        'content' => [
            'nav' => [
                'profile' => 'Profile',
                'orders' => 'Orders',
            ],

            'form' => [
                'title' => 'Profile',
                'description' => 'Here you can change your personal data.',
                'submit' => 'Save',
                'reset' => 'Reset',

                'personal_data' => 'Personal data',

                'firstName' => [
                    'label' => 'First name',
                    'placeholder' => 'Enter first name',
                ],
                'lastName' => [
                    'label' => 'Last name',
                    'placeholder' => 'Enter last name',
                ],
                'email' => [
                    'label' => 'Email',
                    'placeholder' => 'Enter email',
                ],
                'phone' => [
                    'label' => 'Phone',
                    'placeholder' => 'Enter phone',
                ],
                'password' => [
                    'label' => 'Password',
                    'placeholder' => 'Enter password',
                ],
                'password_confirmation' => [
                    'label' => 'Password confirmation',
                    'placeholder' => 'Confirm password',
                ],

                'address' => [
                    'title' => 'Address information',
                    'label' => 'Address',
                    'placeholder' => 'Enter address',
                ],
                'country' => [
                    'label' => 'Country',
                    'placeholder' => 'Select country',
                ],
                'city' => [
                    'label' => 'City',
                    'placeholder' => 'Enter city',
                ],
                'zipCode' => [
                    'label' => 'Zip code',
                    'placeholder' => 'Enter zip code',
                ],
                'avatar' => [
                    'label' => 'Avatar',
                ],
                'avatar_preview' => 'Preview',
            ]
        ]
    ],
    'my_orders' => [
        'title' => 'My orders',
        'breadcrumb' => 'My orders',
        'content' => [
            'title' => 'Orders list',
            'description' => 'List of all orders you have made in our online store.',
            'delete_all' => 'Delete all orders',

            'empty' => [
                'title' => 'No orders',
                'description' => 'You have no orders. You can make an order by going to the <a href=":url" class="link link-primary">models page</a>.',
            ],

            'table' => [
                'bought_at' => 'Bought at',
                'status' => 'Status',
                'amount' => 'Amount',

                'statuses' => [
                    'paid' => 'Paid',
                    'unpaid' => 'Unpaid',
                ],

                'actions' => [
                    'title' => 'Actions',
                    'view' => 'View',
                    'delete' => 'Delete',
                ]
            ],

            'modal' => [
                'title' => 'Order #:order_number',
                'close' => 'Close',

                'empty' => [
                    'title' => 'Nothing found',
                    'description' => 'No items found in this order.',
                ],
                'delete' => [
                    'title' => 'Delete order #:order_number',
                    'description' => 'Are you sure you want to delete order #:order_number?',

                    'actions' => [
                        'cancel' => 'Cancel',
                        'confirm' => 'Delete',
                    ]
                ],

                'delete_all' => [
                    'title' => 'Delete all orders',
                    'description' => 'Are you sure you want to delete all orders?',

                    'actions' => [
                        'cancel' => 'Cancel',
                        'confirm' => 'Delete',
                    ]
                ]
            ],

            'deleted' => [
                'title' => 'Order deleted',
                'message' => 'Order #:id was successfully deleted.',
            ],
        ]
    ],
    'global_search' => [
        'title' => 'Search',
        'breadcrumb' => 'Search',

        'content' => [
            'title' => 'Global search',
            'description' => 'Here you can search for cars, models and spare parts throughout our catalog.',

            'form' => [
                'placeholder' => 'Enter search query',
                'press_enter' => 'Press <kbd>Enter</kbd> to search',
                'search' => 'Search',
            ],

            'list' => [
                'cars' => 'Cars',
                'models' => 'Models',
                'parts' => 'Parts',

                'start_search' => [
                    'title' => 'Start search',
                    'description' => 'Enter search query in the field above.',
                ]
            ]
        ]
    ],
    'stripe' => [
        'title' => 'Order payment',
        'breadcrumb' => 'Order payment',
    ],
    '404' => [
        'title' => 'Error 404',

        'content' => [
            'title' => 'Oops!',
            'description' => 'It looks like this page does not exist.',
            'back_to_home' => 'Back to home',
        ]
    ],
];
