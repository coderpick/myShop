<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'logo' => 'brands/apple.png'],
            ['name' => 'Samsung', 'logo' => 'brands/samsung.png'],
            ['name' => 'Xiaomi', 'logo' => 'brands/xiaomi.png'],
            ['name' => 'OnePlus', 'logo' => 'brands/oneplus.png'],
            ['name' => 'Google', 'logo' => 'brands/google.png'],
            ['name' => 'Huawei', 'logo' => 'brands/huawei.png'],
            ['name' => 'Realme', 'logo' => 'brands/realme.png'],
            ['name' => 'Anker', 'logo' => 'brands/anker.png'],
            ['name' => 'Baseus', 'logo' => 'brands/baseus.png'],
            ['name' => 'Spigen', 'logo' => 'brands/spigen.png'],
            ['name' => 'Dell', 'logo' => 'brands/dell.png'],
            ['name' => 'HP', 'logo' => 'brands/hp.png'],
            ['name' => 'MSI', 'logo' => 'brands/msi.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => $brand['logo'],
                'status' => true, // active
            ]);
        }
    }
}
