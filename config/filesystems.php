<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    "default" => env("FILESYSTEM_DISK", "local"),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    "disks" => [
        "local" => [
            "driver" => "local",
            "root" => storage_path("app"),
            "throw" => false,
        ],

        "public" => [
            "driver" => "local",
            "root" => storage_path("app/public"),
            "url" => env("APP_URL") . "/storage",
            "visibility" => "public",
            "throw" => false,
        ],

        "users_images" => [
            "driver" => "local",
            "root" => public_path("images/users"),
            "url" => env("APP_URL") . "/images/users",
            "visibility" => "public",
            "throw" => false,
        ],

        "car_models" => [
            "driver" => "local",
            "root" => public_path("images/cars/models"),
            "url" => env("APP_URL") . "/images/cars/models",
            "visibility" => "public",
            "throw" => false,
        ],

        "car_icons" => [
            "driver" => "local",
            "root" => public_path("images/cars/icons"),
            "url" => env("APP_URL") . "/images/cars/icons",
            "visibility" => "public",
            "throw" => false,
        ],

        "car_parts" => [
            "driver" => "local",
            "root" => public_path("images/parts"),
            "url" => env("APP_URL") . "/images/parts",
            "visibility" => "public",
            "throw" => false,
        ],

        "s3" => [
            "driver" => "s3",
            "key" => env("AWS_ACCESS_KEY_ID"),
            "secret" => env("AWS_SECRET_ACCESS_KEY"),
            "region" => env("AWS_DEFAULT_REGION"),
            "bucket" => env("AWS_BUCKET"),
            "url" => env("AWS_URL"),
            "endpoint" => env("AWS_ENDPOINT"),
            "use_path_style_endpoint" => env(
                "AWS_USE_PATH_STYLE_ENDPOINT",
                false
            ),
            "throw" => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    "links" => [
        public_path("storage") => storage_path("app/public"),
        public_path("users_images") => storage_path("images/users"),
        public_path("car_models") => storage_path("images/cars/models"),
        public_path("car_icons") => storage_path("images/cars/icons"),
        public_path("car_parts") => storage_path("images/parts"),
    ],
];
