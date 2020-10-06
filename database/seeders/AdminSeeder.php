<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Generator as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(config('app.timezone')),
            'password' => Hash::make('admin123'),
            'image' => 'https://via.placeholder.com/500'
        ]);

        $user->assignRole(\App\Models\Role::ROLE_ADMIN);
    }
}
