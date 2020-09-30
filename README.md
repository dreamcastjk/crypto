<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

#### Requirements
```
php 7.4
MySQL 8
```

#### Configs
```shell script
cp .env.example .env - configure database access
```

```shell script
composer install
npm install
npm run production
```

#### Development
```shell script
php artisan serve
```

#### IDE HELPER
```shell script
php artisan ide-helper:generate - PHPDoc generation for Laravel Facades
php artisan ide-helper:models - PHPDocs for models
php artisan ide-helper:meta - PhpStorm Meta file
```

#### SLEEPINGOWL
В AdminSectionsServiceProvider добавляем в $sections новую секцию User::class => 'App\Admin\Sections\Users', затем выполняем команду, которая генерит файл по указанному пути. Т.е. если указан класс App\Http\Admin\Roles, то для него будет создан файл app/Http/Admin/Roles.php с заранее заготовленным кодом.
 
```shell script
php artisan sleepingowl:section:generate
```
