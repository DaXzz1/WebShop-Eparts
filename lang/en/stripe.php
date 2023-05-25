<?php

return [
    "form" => [
        "required_info" => [
            "title" => "Required information",
            "description" => "Please fill in the required information to complete your order.",

            "shipping_address" => "Shipping address",

            "inputs" => [
                "firstname" => [
                    "label" => "First name",
                    "placeholder" => "Enter your first name",
                ],
                "lastname" => [
                    "label" => "Last name",
                    "placeholder" => "Enter your last name",
                ],
                "email" => [
                    "label" => "Email",
                    "placeholder" => "Enter your email",
                ],
                "phone" => [
                    "label" => "Phone",
                    "placeholder" => "Enter your phone",
                ],
                "country" => [
                    "label" => "Country",
                    "placeholder" => "Select country",
                ],
                "city" => [
                    "label" => "City",
                    "placeholder" => "Enter your city",
                ],
                'state' => [
                    'label' => 'State',
                    'placeholder' => 'Enter your state',
                ],
                "address" => [
                    "label" => "Address",
                    "placeholder" => "Enter your address",
                ],
                "address2" => [
                    "label" => "Address 2",
                    "placeholder" => "Enter your address 2",
                ],
                "zip" => [
                    "label" => "Zip code",
                    "placeholder" => "Enter your zip code",
                ],
            ]
        ],
        "optional_info" => [
            "title" => "Additional information",
            "description" => "If you want to add more information, you can do it here.",

            "inputs" => [
                "notes" => [
                    "label" => "Notes",
                    "placeholder" => "Enter your notes...",
                ],
            ]
        ],
    ],
    "order" => [
        "list" => [
            "title" => "Your order",
            "description" => "This is a summary of your order. You can remove items from your shopping cart by clicking on the button with the cart icon.",

            "table" => [
                "product" => "Product",
                "total" => "Total",

                "more_items" => [
                    "singular" => "+ :count item",
                    "plural" => "+ :count items",
                ]
            ],
            "totals" => [
                "title" => "Total",
                "subtotal" => [
                    "title" => "Subtotal",
                    "taxes" => "Taxes included",
                ],
                "shipping" => [
                    "title" => "Shipping",
                    "upon" => "Upon checkout",
                ],
                "total" => "Total",
                "checkout" => "Proceed to checkout",
            ],
        ],
        "modal" => [
            "title" => "Order overview",
        ],
        "info" => [
            'title' => 'Order information',
            'description' => "This is your order information. Please check it before proceeding.",

            "shipping_cost" => [
                "title" => "Shipping cost",
                "free" => "Free",
            ],
            "approx_shipping_date" => "Approximate shipping date",
            "total" => "Total",

            'save_info' => "Save information for next order",
            "pay" => "Pay",
            "terms_and_conditions" => "By clicking on the button, you agree to the <a href=':url' class='text-primary link link-primary link-hover' target='_blank'>terms and conditions</a>.",
        ]
    ],
    'success' => [
        'title' => 'Thank you for your order, :name!',
        'description' => 'Your order has been successfully placed. We will notify you by email as soon as it is shipped.',
        'button' => 'Return to home',
        'receipt' => 'View receipt',
        'my_orders' => 'My orders',
    ],
];
