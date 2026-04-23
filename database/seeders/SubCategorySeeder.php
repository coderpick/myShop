<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    public function run()
    {

        $data = [
            'Home Appliances' => [
                'Mixer Grinder & Blender',
                'Microwave Oven',
                'Air Fryer',
                'Induction Cooker',
                'Gas Stove',
                'Kitchen Hood',
                'Air Conditioner',
                'Power Station',
                'Rice Cooker',
            ],
            'Mobile Phone' => [
                'iPhone',
                'Android Phone',
                'Feature Phone',
            ],
            'Laptop' => [
                'Gaming Laptop',
                'Business Laptop',
                'Ultrabook',
            ],
            'Tablet & Accessories' => [
                'Tablet',
                'Stylus Pen',
            ],
            'Smart Watch' => [
                'Smart Watch',
            ],
            'Headphone' => [
                'Headphone',
            ],
            'Speakers' => [
                'Speakers',
            ],
            'Airpods' => [
                'Airpods',
            ],
            'Adapter' => [
                'Adapter',
            ],
            'Cables' => [
                'Cables',
            ],
            'Hubs & Docks' => [
                'Hubs & Docks',
            ],
            'Wireless Charger' => [
                'Wireless Charger',
            ],
            'Smart Pen' => [
                'Smart Pen',
            ],
        ];

        foreach ($data as $categoryName => $subs) {

            $category = Category::where('name', $categoryName)->first();

            if (! $category) {
                continue;
            }

            foreach ($subs as $sub) {
                SubCategory::create([
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
