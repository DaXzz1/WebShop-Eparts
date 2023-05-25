const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            screens: {
                xs: "475px",
            },
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/line-clamp"),
        require("flowbite/plugin"),
        require("daisyui"),
    ],
    daisyui: {
        styled: true,
        themes: ["bumblebee"],
        base: true,
        utils: true,
    },
};
