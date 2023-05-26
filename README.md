<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Table Of Contents
-   [Installation](https://github.com/DaXzz1/WebShop-Eparts#installation)
-   [Technologies](https://github.com/DaXzz1/WebShop-Eparts#technologies)
-   [Authors](https://github.com/DaXzz1/WebShop-Eparts#authors)
-   [License](https://github.com/DaXzz1/WebShop-Eparts#license)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installation

1. <b>Clone the repository</b>
```bash
git clone https://github.com/DaXzz1/WebShop-Eparts.git
```
2. <b>Switch to the repo folder</b>
```bash
 cd WebShop-Eparts
 ```
3. <b>Install all the dependencies using composer</b>
```bash
 composer install
```
4. <b>Copy the example env file and make the required configuration changes in the .env file</b>
```bash
cp .env.example .env
```
5. <b>Generate a new application key</b>
```bash
php artisan key:generate
```
6. <b>Generate a new JWT authentication secret key</b>
```bash
php artisan jwt:generate
```
7. <b>Run the database migrations (Set the database connection in .env before migrating)</b>
```bash
php artisan migrate:refresh --seed
```
8. <b>Start the local development server</b>
```bash
php artisan serve
```
9. <b>Build frontend and start watching any changes</b>
```bash
npm run dev
```

## Technologies

-   **[Prettier](https://prettier.io/)**: Code Formatter
-   **[Tailwind CSS](https://tailwindcss.com/)**: CSS framework
-   **[Tippy.js](https://atomiks.github.io/tippyjs/)**: JavaScript tooltip library
-   **[Vite](https://vitejs.dev/)**: Building Tools for Web Application Development
-   **[DaisyUI](https://daisyui.com/)**: A set of pre-made styles and components
-   **[Axios](https://axios-http.com/)**: HTTP client
-   **[Stripe](https://stripe.com/)**: Payment platform
-   **[Filament](https://filamentapp.com/)**: Administrative interface
-   **[MySQL](https://www.mysql.com/)**: Relational database
-   **[Laravel](https://laravel.com/)**: Framework for developing web applications

## Authors

-   **[Bogdan Fedortsenko](https://github.com/DaXzz1)**
-   **[Danil Barsukov](https://github.com/Nell0w)**

## License

This project is licensed under the MIT License - see the [LICENSE](https://github.com/DaXzz1/WebShop-Eparts/blob/main/LICENSE) file for details.
