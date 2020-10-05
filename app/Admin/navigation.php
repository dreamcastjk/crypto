<?php

use App\Models\Product;
use App\Models\User;
use SleepingOwl\Admin\Navigation\Page;

AdminNavigation::setFromArray([
    (new Page(User::class))->setTitle('Пользователи')->addBadge(function () { return User::count(); }),
    (new Page(Product::class))->setTitle('Продукты')->addBadge(function () { return Product::count(); }),
    (new Page())->setTitle('Информация')->setUrl(route('admin.information')),
]);
