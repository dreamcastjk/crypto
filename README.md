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

#### PHP extensions
```shell script
sudo apt install php7.4-common php7.4-json php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd imagemagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y
```

#### Configs
```shell script
cp .env.example .env - configure database access
```

```shell script
composer install
php artisan migrate || php artisan migrate:fresh --seed 
php artisan key:generate
npm install
npm run dev
npm run production
```

#### Tests
```shell script
Создать тестовую БД

cp .env.testing.example .env.testing #заполняем актуальными конфигами
php artisan migrate:fresh --env=testing #накат миграций на тестовую БД
php artisan key:generate --env=testing #генерация ключа приложения на тесты
php artisan test --env=testing #запуск тестов
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
php artisan sleepingowl:ide:generate - PHPDoc generation for SleepingOwlAdmin Facades
```

#### SLEEPINGOWL
В AdminSectionsServiceProvider добавляем в $sections новую секцию User::class => 'App\Admin\Sections\Users', затем выполняем команду, которая генерит файл по указанному пути. Т.е. если указан класс App\Http\Admin\Roles, то для него будет создан файл app/Http/Admin/Roles.php с заранее заготовленным кодом.
 
```shell script
php artisan sleepingowl:section:generate
```
