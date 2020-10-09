<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        User::factory()->hasInfo()->count(10)->create();
        Product::factory()->hasInfo()->count(20)->create();
    }
}
