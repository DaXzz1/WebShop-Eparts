<?php

return [
    'order' => [
        'not_found' => [
            'title' => 'Order not found',
            'message' => 'Order #:id not found.',
        ],

        'deleted' => [
            'title' => 'Order deleted',
            'message' => 'Order #:id was successfully deleted.',
        ],

        'deleted_all' => [
            'title' => 'Orders deleted',
            'message' => 'All orders were successfully deleted.',
        ],
    ],
    'cart' => [
        'product_not_found' => [
            'title' => 'Product not found',
            'message' => 'Product #:id not found.',
        ],

        'added' => [
            'title' => 'Product added',
            'message' => 'Product was successfully added to cart.',
        ],

        'incremented' => [
            'title' => 'Product updated',
            'message' => 'Product quantity was successfully updated.',
        ],

        'decremented' => [
            'title' => 'Product updated',
            'message' => 'Product quantity was successfully updated.',
        ],

        'removed' => [
            'title' => 'Product removed',
            'message' => 'Product was successfully removed from cart.',
        ],

        'cleared' => [
            'title' => 'Cart cleared',
            'message' => 'Cart was successfully cleared.',
        ],

        'countUpdated' => [
            'title' => 'Product quantity updated',
            'message' => 'Product quantity was successfully updated.',
        ],

        'count_exceeded' => [
        'title' => 'Product quantity exceeded',
        'message' => 'Product quantity <b>#:id</b> exceeded.',
        ],
    ],
    'profile' => [
        'updated' => [
            'title' => 'Profile updated',
            'message' => 'Profile was successfully updated.',
        ],

        'validation_error' => [
            'title' => 'Validation error',
            'message' => 'Please check the entered data.',
        ],

        'password_not_match' => [
            'title' => 'Passwords do not match',
            'message' => 'Passwords do not match.',
        ],

        'password_same' => [
            'title' => 'New password matches the old one',
            'message' => 'New password matches the old one.',
        ],
    ],
];
