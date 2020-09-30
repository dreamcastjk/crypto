<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role
{
    const ROLE_USER = 'user';
    const PERMISSION_VIEW_CONTENT = 'ViewContent';

    const ROLE_ADMIN = 'admin';
    const PERMISSION_ALL = 'All';
}
