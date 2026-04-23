<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $categories = [
            ['name' => 'Mobile Phone', 'icon' => 'bi bi-phone', 'is_show_in_menu' => true],
            ['name' => 'Laptop', 'icon' => 'bi bi-laptop', 'is_show_in_menu' => true],
            ['name' => 'Tablet & Accessories', 'icon' => 'bi bi-tablet', 'is_show_in_menu' => true],
            ['name' => 'Smart Watch', 'icon' => 'bi bi-smartwatch', 'is_show_in_menu' => true],
            ['name' => 'Headphone', 'icon' => 'bi bi-headphones', 'is_show_in_menu' => true],
            ['name' => 'Speakers', 'icon' => 'bi bi-speaker', 'is_show_in_menu' => true],
            ['name' => 'Home Appliances', 'icon' => 'bi bi-house', 'is_show_in_menu' => true],
            ['name' => 'Airpods', 'icon' => 'bi bi-earbuds', 'is_show_in_menu' => false],
            ['name' => 'Adapter', 'icon' => 'bi bi-plug', 'is_show_in_menu' => false],
            ['name' => 'Cables', 'icon' => 'bi bi-usb', 'is_show_in_menu' => false],
            ['name' => 'Hubs & Docks', 'icon' => 'bi bi-hdd-network', 'is_show_in_menu' => false],
            ['name' => 'Wireless Charger', 'icon' => 'bi bi-battery-charging', 'is_show_in_menu' => false],
            ['name' => 'Smart Pen', 'icon' => 'bi bi-pencil', 'is_show_in_menu' => false],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
                'is_show_in_menu' => $cat['is_show_in_menu'],
            ]);
        }
    }
}
