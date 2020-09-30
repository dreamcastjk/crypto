<?php

use App\Models\User;
use SleepingOwl\Admin\Navigation\Page;

AdminNavigation::setFromArray([
    (new Page(User::class))->setTitle('Пользователи')->addBadge(function () { return User::count(); }),
]);