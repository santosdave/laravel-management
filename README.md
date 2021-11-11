# Laravel 8 Boilerplate

This template is for educational only
## Features
- SPA CRUD (no reload-reload club with ajax)
- Serverside Datatable with Pdf/Excel
- Sweetalert2
- Metronic Template <a href="https://preview.keenthemes.com/metronic/demo1/index.html"> here </a>
- Many More

### Installation

#### -run composer
```
composer install
```
#### -run key generate
```
php artisan key:generate
```
#### -set your database in file .env and in your phpmysql or etc

#### -run migrate
```
php artisan migrate
```

#### -run 
```
php artisan serve
```
#### Optional
-for first register type manually "YOUR_URL/register"

you can setting login page default with:
go to vendor/laravel/ui/auth-backend/authenticatesuser
on showloginform() replace auth.login with v_login 


