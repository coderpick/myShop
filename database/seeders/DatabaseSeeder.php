<?php

namespace Database\Seeders;

use Database\Seeders\ProductSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class
        ]);

    }
}
