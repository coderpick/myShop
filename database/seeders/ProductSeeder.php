<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();

        // Load images from public/uploads/products
        $imageFiles = File::isDirectory(public_path('uploads/products')) ? File::files(public_path('uploads/products')) : [];
        $availableImages = [];
        foreach ($imageFiles as $file) {
            if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp'])) {
                $availableImages[] = 'uploads/products/' . $file->getFilename();
            }
        }

        $products = [
            // Mobile Phones
            ['name' => 'iPhone 15 Pro Max', 'category' => 'Mobile Phone', 'short_desc' => 'Latest iPhone with A17 Pro chip', 'desc' => 'Experience the future with iPhone 15 Pro Max featuring A17 Pro chip, titanium design, and advanced camera system.', 'price' => 1199, 'discount' => 5, 'stock' => 50, 'sku' => 'IP15PM-256', 'brand' => 'Apple', 'flags' => ['is_popular', 'is_bestseller', 'is_new_arrival']],
            ['name' => 'iPhone 15 Pro', 'category' => 'Mobile Phone', 'short_desc' => 'Professional iPhone with titanium build', 'desc' => 'iPhone 15 Pro with A17 Pro chip, titanium frame, and pro camera system.', 'price' => 999, 'discount' => 3, 'stock' => 45, 'sku' => 'IP15P-256', 'brand' => 'Apple', 'flags' => ['is_featured']],
            ['name' => 'iPhone 15', 'category' => 'Mobile Phone', 'short_desc' => 'Standard iPhone with A16 chip', 'desc' => 'iPhone 15 with A16 Bionic chip, dual camera system, and vibrant colors.', 'price' => 799, 'discount' => 0, 'stock' => 60, 'sku' => 'IP15-128', 'brand' => 'Apple', 'flags' => ['is_new_arrival']],
            ['name' => 'Samsung Galaxy S24 Ultra', 'category' => 'Mobile Phone', 'short_desc' => 'Ultimate Galaxy experience', 'desc' => 'Samsung Galaxy S24 Ultra with S Pen, 200MP camera, and AI features.', 'price' => 1299, 'discount' => 8, 'stock' => 40, 'sku' => 'SG24U-512', 'brand' => 'Samsung', 'flags' => ['is_popular', 'is_trending', 'is_bestseller']],
            ['name' => 'Samsung Galaxy S24+', 'category' => 'Mobile Phone', 'short_desc' => 'Premium Galaxy smartphone', 'desc' => 'Samsung Galaxy S24+ with dynamic display and advanced AI capabilities.', 'price' => 999, 'discount' => 5, 'stock' => 35, 'sku' => 'SG24P-256', 'brand' => 'Samsung', 'flags' => ['is_featured']],
            ['name' => 'Samsung Galaxy S25', 'category' => 'Mobile Phone', 'short_desc' => 'Compact flagship phone', 'desc' => 'Samsung Galaxy S24 with compact design and powerful performance.', 'price' => 799, 'discount' => 0, 'stock' => 50, 'sku' => 'SG24-128', 'brand' => 'Samsung', 'flags' => ['is_new_arrival']],
            ['name' => 'Samsung Galaxy Z Fold 5', 'category' => 'Mobile Phone', 'short_desc' => 'Foldable smartphone innovation', 'desc' => 'Samsung Galaxy Z Fold 5 with foldable display and productivity features.', 'price' => 1799, 'discount' => 10, 'stock' => 25, 'sku' => 'ZF5-512', 'brand' => 'Samsung', 'flags' => ['is_trending', 'is_featured']],
            ['name' => 'Xiaomi 14 Pro', 'category' => 'Mobile Phone', 'short_desc' => 'Professional photography phone', 'desc' => 'Xiaomi 14 Pro with Leica optics and Snapdragon 8 Gen 3.', 'price' => 899, 'discount' => 7, 'stock' => 40, 'sku' => 'XM14P-256', 'brand' => 'Xiaomi', 'flags' => ['is_popular', 'is_bestseller']],
            ['name' => 'Xiaomi 14', 'category' => 'Mobile Phone', 'short_desc' => 'Compact flagship with Leica camera', 'desc' => 'Xiaomi 14 compact flagship with Leica camera system.', 'price' => 699, 'discount' => 5, 'stock' => 45, 'sku' => 'XM14-256', 'brand' => 'Xiaomi', 'flags' => ['is_new_arrival']],
            ['name' => 'OnePlus 12', 'category' => 'Mobile Phone', 'short_desc' => 'Flagship killer returns', 'desc' => 'OnePlus 12 with Hasselblad camera and top-tier specifications.', 'price' => 799, 'discount' => 8, 'stock' => 55, 'sku' => 'OP12-256', 'brand' => 'OnePlus', 'flags' => ['is_popular', 'is_trending']],
            ['name' => 'OnePlus 12R', 'category' => 'Mobile Phone', 'short_desc' => 'Premium mid-range phone', 'desc' => 'OnePlus 12R with flagship features at accessible price.', 'price' => 499, 'discount' => 0, 'stock' => 60, 'sku' => 'OP12R-128', 'brand' => 'OnePlus', 'flags' => ['is_bestseller', 'is_featured']],
            ['name' => 'Google Pixel 8 Pro', 'category' => 'Mobile Phone', 'short_desc' => 'AI-powered smartphone', 'desc' => 'Google Pixel 8 Pro with Tensor G3 chip and AI features.', 'price' => 999, 'discount' => 10, 'stock' => 35, 'sku' => 'GP8P-256', 'brand' => 'Google', 'flags' => ['is_popular', 'is_trending', 'is_new_arrival']],
            ['name' => 'Google Pixel 8', 'category' => 'Mobile Phone', 'short_desc' => 'Compact AI phone', 'desc' => 'Google Pixel 8 with compact design and AI capabilities.', 'price' => 699, 'discount' => 8, 'stock' => 40, 'sku' => 'GP8-128', 'brand' => 'Google', 'flags' => ['is_featured']],
            ['name' => 'Realme GT 5 Pro', 'category' => 'Mobile Phone', 'short_desc' => 'Performance flagship', 'desc' => 'Realme GT 5 Pro with Snapdragon 8 Gen 3 and fast charging.', 'price' => 599, 'discount' => 5, 'stock' => 50, 'sku' => 'RG5P-256', 'brand' => 'Realme', 'flags' => ['is_bestseller']],
            ['name' => 'Huawei Mate 60 Pro', 'category' => 'Mobile Phone', 'short_desc' => 'Premium Huawei flagship', 'desc' => 'Huawei Mate 60 Pro with advanced camera and design.', 'price' => 1099, 'discount' => 0, 'stock' => 30, 'sku' => 'HM60P-512', 'brand' => 'Huawei', 'flags' => ['is_trending', 'is_featured']],

            // Laptops
            ['name' => 'MacBook Pro 16" M3 Max', 'category' => 'Laptop', 'short_desc' => 'Ultimate professional laptop', 'desc' => 'MacBook Pro 16" with M3 Max chip, up to 128GB RAM for professionals.', 'price' => 3499, 'discount' => 5, 'stock' => 20, 'sku' => 'MBP16-M3M', 'brand' => 'Apple', 'flags' => ['is_popular', 'is_bestseller', 'is_featured']],
            ['name' => 'MacBook Pro 14" M3 Pro', 'category' => 'Laptop', 'short_desc' => 'Portable professional laptop', 'desc' => 'MacBook Pro 14" with M3 Pro chip, perfect for professionals on the go.', 'price' => 1999, 'discount' => 3, 'stock' => 25, 'sku' => 'MBP14-M3P', 'brand' => 'Apple', 'flags' => ['is_trending']],
            ['name' => 'MacBook Air 15" M3', 'category' => 'Laptop', 'short_desc' => 'Large screen ultrabook', 'desc' => 'MacBook Air 15" with M3 chip, lightweight and powerful.', 'price' => 1299, 'discount' => 0, 'stock' => 30, 'sku' => 'MBA15-M3', 'brand' => 'Apple', 'flags' => ['is_new_arrival']],
            ['name' => 'MacBook Air 13" M3', 'category' => 'Laptop', 'short_desc' => 'Compact ultrabook', 'desc' => 'MacBook Air 13" with M3 chip, ultimate portability.', 'price' => 1099, 'discount' => 0, 'stock' => 40, 'sku' => 'MBA13-M3', 'brand' => 'Apple', 'flags' => ['is_bestseller']],
            ['name' => 'Samsung Galaxy Book4 Pro', 'category' => 'Laptop', 'short_desc' => 'Windows ultrabook', 'desc' => 'Samsung Galaxy Book4 Pro with OLED display and Intel Core Ultra.', 'price' => 1449, 'discount' => 8, 'stock' => 25, 'sku' => 'GB4P-512', 'brand' => 'Samsung', 'flags' => ['is_popular', 'is_featured']],
            ['name' => 'Dell XPS 15', 'category' => 'Laptop', 'short_desc' => 'Premium Windows laptop', 'desc' => 'Dell XPS 15 with OLED display and Intel Core i7.', 'price' => 1899, 'discount' => 10, 'stock' => 20, 'sku' => 'DXPS15-512', 'brand' => 'Dell', 'flags' => ['is_trending', 'is_bestseller']],
            ['name' => 'Dell XPS 13', 'category' => 'Laptop', 'short_desc' => 'Compact premium laptop', 'desc' => 'Dell XPS 13 with compact design and powerful performance.', 'price' => 1299, 'discount' => 5, 'stock' => 30, 'sku' => 'DXPS13-512', 'brand' => 'Dell', 'flags' => ['is_new_arrival']],
            ['name' => 'HP Spectre x360 14', 'category' => 'Laptop', 'short_desc' => '2-in-1 convertible', 'desc' => 'HP Spectre x360 with OLED display and 2-in-1 design.', 'price' => 1599, 'discount' => 8, 'stock' => 20, 'sku' => 'HPSX360-512', 'brand' => 'HP', 'flags' => ['is_featured']],
            ['name' => 'HP Pavilion Plus 14', 'category' => 'Laptop', 'short_desc' => 'Mid-range OLED laptop', 'desc' => 'HP Pavilion Plus with OLED display at affordable price.', 'price' => 999, 'discount' => 0, 'stock' => 35, 'sku' => 'HPVP14-512', 'brand' => 'HP', 'flags' => ['is_bestseller']],
            ['name' => 'MSI Titan 18', 'category' => 'Laptop', 'short_desc' => 'Ultimate gaming laptop', 'desc' => 'MSI Titan 18 with RTX 4090 and 4K display.', 'price' => 3999, 'discount' => 5, 'stock' => 10, 'sku' => 'MSIT18-4090', 'brand' => 'MSI', 'flags' => ['is_popular', 'is_trending']],
            ['name' => 'MSI Stealth 16', 'category' => 'Laptop', 'short_desc' => 'Sleek gaming laptop', 'desc' => 'MSI Stealth 16 with thin design and powerful specs.', 'price' => 2499, 'discount' => 7, 'stock' => 15, 'sku' => 'MSIS16-4080', 'brand' => 'MSI', 'flags' => ['is_featured']],
            ['name' => 'Xiaomi RedmiBook Pro 16', 'category' => 'Laptop', 'short_desc' => 'Value flagship laptop', 'desc' => 'Xiaomi RedmiBook Pro with high-res display and good performance.', 'price' => 899, 'discount' => 5, 'stock' => 30, 'sku' => 'XRBP16-512', 'brand' => 'Xiaomi', 'flags' => ['is_bestseller']],

            // Smart Watches
            ['name' => 'Apple Watch Ultra 2', 'category' => 'Smart Watch', 'short_desc' => 'Ultimate sports watch', 'desc' => 'Apple Watch Ultra 2 with rugged design and extended battery.', 'price' => 799, 'discount' => 5, 'stock' => 40, 'sku' => 'AWU2-49', 'brand' => 'Apple', 'flags' => ['is_popular', 'is_bestseller', 'is_trending']],
            ['name' => 'Apple Watch Series 9', 'category' => 'Smart Watch', 'short_desc' => 'Latest Apple Watch', 'desc' => 'Apple Watch Series 9 with S9 chip and new features.', 'price' => 399, 'discount' => 0, 'stock' => 60, 'sku' => 'AWS9-45', 'brand' => 'Apple', 'flags' => ['is_new_arrival', 'is_featured']],
            ['name' => 'Samsung Galaxy Watch 6 Classic', 'category' => 'Smart Watch', 'short_desc' => 'Premium Samsung watch', 'desc' => 'Samsung Galaxy Watch 6 Classic with rotating bezel.', 'price' => 399, 'discount' => 8, 'stock' => 45, 'sku' => 'GW6C-47', 'brand' => 'Samsung', 'flags' => ['is_popular']],
            ['name' => 'Samsung Galaxy Watch 6', 'category' => 'Smart Watch', 'short_desc' => 'Standard Samsung watch', 'desc' => 'Samsung Galaxy Watch 6 with advanced health tracking.', 'price' => 299, 'discount' => 5, 'stock' => 50, 'sku' => 'GW6-44', 'brand' => 'Samsung', 'flags' => ['is_bestseller']],
            ['name' => 'Samsung Galaxy Watch 5 Pro', 'category' => 'Smart Watch', 'short_desc' => 'Pro sports watch', 'desc' => 'Samsung Galaxy Watch 5 Pro with titanium build.', 'price' => 449, 'discount' => 10, 'stock' => 35, 'sku' => 'GW5P-45', 'brand' => 'Samsung', 'flags' => ['is_trending']],
            ['name' => 'Google Pixel Watch 2', 'category' => 'Smart Watch', 'short_desc' => 'Google smartwatch', 'desc' => 'Google Pixel Watch 2 with Fitbit integration.', 'price' => 349, 'discount' => 5, 'stock' => 40, 'sku' => 'GPW2-41', 'brand' => 'Google', 'flags' => ['is_featured', 'is_new_arrival']],
            ['name' => 'OnePlus Watch 2', 'category' => 'Smart Watch', 'short_desc' => 'Premium OnePlus watch', 'desc' => 'OnePlus Watch 2 with dual engine architecture.', 'price' => 249, 'discount' => 0, 'stock' => 45, 'sku' => 'OPW2-46', 'brand' => 'OnePlus', 'flags' => ['is_bestseller']],
            ['name' => 'Xiaomi Watch 2 Pro', 'category' => 'Smart Watch', 'short_desc' => 'Value smartwatch', 'desc' => 'Xiaomi Watch 2 Pro with AMOLED display.', 'price' => 179, 'discount' => 8, 'stock' => 50, 'sku' => 'XMW2P-46', 'brand' => 'Xiaomi', 'flags' => ['is_popular']],

            // Headphones
            ['name' => 'Apple AirPods Max', 'category' => 'Headphone', 'short_desc' => 'Premium over-ear headphones', 'desc' => 'Apple AirPods Max with spatial audio and premium build.', 'price' => 549, 'discount' => 5, 'stock' => 30, 'sku' => 'APM-SILVER', 'brand' => 'Apple', 'flags' => ['is_popular', 'is_bestseller']],
            ['name' => 'Apple AirPods Pro 2nd Gen', 'category' => 'Headphone', 'short_desc' => 'Pro earbuds with ANC', 'desc' => 'Apple AirPods Pro with H2 chip and active noise cancellation.', 'price' => 249, 'discount' => 0, 'stock' => 80, 'sku' => 'APP2-USB', 'brand' => 'Apple', 'flags' => ['is_trending', 'is_featured', 'is_new_arrival']],
            ['name' => 'Apple AirPods 3rd Gen', 'category' => 'Headphone', 'short_desc' => 'Standard AirPods', 'desc' => 'Apple AirPods 3rd generation with spatial audio.', 'price' => 169, 'discount' => 0, 'stock' => 70, 'sku' => 'AP3-MAGIC', 'brand' => 'Apple', 'flags' => ['is_bestseller']],
            ['name' => 'Samsung Galaxy Buds2 Pro', 'category' => 'Headphone', 'short_desc' => 'Premium Samsung earbuds', 'desc' => 'Samsung Galaxy Buds2 Pro with 24-bit audio.', 'price' => 229, 'discount' => 10, 'stock' => 50, 'sku' => 'GBD2P-WHT', 'brand' => 'Samsung', 'flags' => ['is_popular']],
            ['name' => 'Samsung Galaxy Buds2', 'category' => 'Headphone', 'short_desc' => 'Mid-range earbuds', 'desc' => 'Samsung Galaxy Buds2 with active noise cancellation.', 'price' => 149, 'discount' => 8, 'stock' => 60, 'sku' => 'GBD2-BLK', 'brand' => 'Samsung', 'flags' => ['is_featured']],
            ['name' => 'Sony WH-1000XM5', 'category' => 'Headphone', 'short_desc' => 'Best noise cancelling headphones', 'desc' => 'Sony WH-1000XM5 with industry-leading ANC.', 'price' => 399, 'discount' => 10, 'stock' => 40, 'sku' => 'SW1000XM5-BLK', 'brand' => 'Samsung', 'flags' => ['is_trending', 'is_bestseller']],
            ['name' => 'OnePlus Buds Pro 2', 'category' => 'Headphone', 'short_desc' => 'Premium OnePlus earbuds', 'desc' => 'OnePlus Buds Pro 2 with spatial audio.', 'price' => 149, 'discount' => 5, 'stock' => 55, 'sku' => 'OBP2-BLK', 'brand' => 'OnePlus', 'flags' => ['is_new_arrival']],
            ['name' => 'Anker Soundcore Space Q45', 'category' => 'Headphone', 'short_desc' => 'Value ANC headphones', 'desc' => 'Anker Soundcore Space Q45 with adaptive ANC.', 'price' => 149, 'discount' => 15, 'stock' => 45, 'sku' => 'ASQ45-BLK', 'brand' => 'Anker', 'flags' => ['is_bestseller', 'is_featured']],

            // Speakers
            ['name' => 'Apple HomePod (2nd Gen)', 'category' => 'Speakers', 'short_desc' => 'Premium smart speaker', 'desc' => 'Apple HomePod with spatial audio and Siri.', 'price' => 299, 'discount' => 0, 'stock' => 35, 'sku' => 'HP2-MIDNIGHT', 'brand' => 'Apple', 'flags' => ['is_popular']],
            ['name' => 'Apple HomePod Mini', 'category' => 'Speakers', 'short_desc' => 'Compact smart speaker', 'desc' => 'Apple HomePod Mini with powerful sound.', 'price' => 99, 'discount' => 0, 'stock' => 60, 'sku' => 'HPM-BLUE', 'brand' => 'Apple', 'flags' => ['is_bestseller']],
            ['name' => 'Samsung Galaxy Home Mini 2', 'category' => 'Speakers', 'short_desc' => 'Compact smart speaker', 'desc' => 'Samsung Galaxy Home Mini 2 with Bixby.', 'price' => 79, 'discount' => 10, 'stock' => 40, 'sku' => 'GHM2-BLK', 'brand' => 'Samsung', 'flags' => ['is_new_arrival']],
            ['name' => 'JBL Flip 6', 'category' => 'Speakers', 'short_desc' => 'Portable Bluetooth speaker', 'desc' => 'JBL Flip 6 with powerful bass and waterproof design.', 'price' => 129, 'discount' => 8, 'stock' => 50, 'sku' => 'JBLF6-BLK', 'brand' => 'Samsung', 'flags' => ['is_trending', 'is_featured']],
            ['name' => 'JBL Charge 5', 'category' => 'Speakers', 'short_desc' => 'Portable speaker with power bank', 'desc' => 'JBL Charge 5 with built-in power bank.', 'price' => 179, 'discount' => 5, 'stock' => 40, 'sku' => 'JC5-BLU', 'brand' => 'Samsung', 'flags' => ['is_popular']],
            ['name' => 'Xiaomi Mi Portable Speaker', 'category' => 'Speakers', 'short_desc' => 'Compact Bluetooth speaker', 'desc' => 'Xiaomi portable speaker with 360° sound.', 'price' => 59, 'discount' => 10, 'stock' => 55, 'sku' => 'XMPS-BLK', 'brand' => 'Xiaomi', 'flags' => ['is_bestseller']],

            // Home Appliances
            ['name' => 'Dyson V15 Detect', 'category' => 'Home Appliances', 'short_desc' => 'Premium cordless vacuum', 'desc' => 'Dyson V15 Detect with laser dust detection.', 'price' => 749, 'discount' => 8, 'stock' => 20, 'sku' => 'DV15-CYAN', 'brand' => 'Samsung', 'flags' => ['is_popular', 'is_featured']],
            ['name' => 'Dyson Airwrap Complete', 'category' => 'Home Appliances', 'short_desc' => 'Multi-style hair tool', 'desc' => 'Dyson Airwrap for curling, smoothing, and drying.', 'price' => 599, 'discount' => 5, 'stock' => 25, 'sku' => 'DA-NICKEL', 'brand' => 'Samsung', 'flags' => ['is_bestseller', 'is_trending']],
            ['name' => 'Roborock S8 Pro Ultra', 'category' => 'Home Appliances', 'short_desc' => 'Premium robot vacuum', 'desc' => 'Roborock S8 Pro Ultra with self-cleaning base.', 'price' => 899, 'discount' => 10, 'stock' => 15, 'sku' => 'RS8-WHT', 'brand' => 'Xiaomi', 'flags' => ['is_popular']],
            ['name' => 'Xiaomi Mi Air Purifier 4 Pro', 'category' => 'Home Appliances', 'short_desc' => 'Smart air purifier', 'desc' => 'Xiaomi air purifier with HEPA filter.', 'price' => 199, 'discount' => 8, 'stock' => 30, 'sku' => 'XMAP4-WHT', 'brand' => 'Xiaomi', 'flags' => ['is_featured', 'is_new_arrival']],

            // Accessories
            ['name' => 'Anker 737 Power Bank', 'category' => 'Airpods', 'short_desc' => '24000mAh power bank', 'desc' => 'Anker 737 with 140W output and large capacity.', 'price' => 149, 'discount' => 10, 'stock' => 40, 'sku' => 'A737-BLK', 'brand' => 'Anker', 'flags' => ['is_popular', 'is_bestseller']],
            ['name' => 'Anker 65W GaN Charger', 'category' => 'Adapter', 'short_desc' => 'Fast GaN charger', 'desc' => 'Anker 65W GaN charger for laptops and phones.', 'price' => 49, 'discount' => 15, 'stock' => 80, 'sku' => 'A65G-WHT', 'brand' => 'Anker', 'flags' => ['is_trending']],
            ['name' => 'Anker 100W USB-C Cable', 'category' => 'Cables', 'short_desc' => 'Premium charging cable', 'desc' => 'Anker 100W USB-C to C cable, 6ft.', 'price' => 25, 'discount' => 0, 'stock' => 100, 'sku' => 'A100C-BLK', 'brand' => 'Anker', 'flags' => ['is_featured']],
            ['name' => 'Baseus 100W USB-C Hub', 'category' => 'Hubs & Docks', 'short_desc' => 'Multi-port hub', 'desc' => 'Baseus 100W hub with multiple ports.', 'price' => 59, 'discount' => 10, 'stock' => 50, 'sku' => 'BSHUB-SLV', 'brand' => 'Baseus', 'flags' => ['is_popular']],
            ['name' => 'Spigen Ultra Hybrid iPhone 15 Case', 'category' => 'Cables', 'short_desc' => 'Protective phone case', 'desc' => 'Spigen clear case with kickstand.', 'price' => 18, 'discount' => 0, 'stock' => 120, 'sku' => 'SGIH15-CLR', 'brand' => 'Spigen', 'flags' => ['is_bestseller']],
            ['name' => 'Anker Wireless Charging Pad', 'category' => 'Wireless Charger', 'short_desc' => '15W wireless charger', 'desc' => 'Anker wireless charging pad for all devices.', 'price' => 29, 'discount' => 15, 'stock' => 70, 'sku' => 'AWC-BLK', 'brand' => 'Anker', 'flags' => ['is_new_arrival', 'is_featured']],
        ];

        foreach ($products as $productData) {
            $brand = $brands->where('name', $productData['brand'])->first();
            $category = $categories->where('name', $productData['category'])->first();

            if (!$brand || !$category) {
                continue;
            }

            $subCategory = SubCategory::where('category_id', $category->id)->inRandomOrder()->first();

            $discountPrice = $productData['price'] * (1 - $productData['discount'] / 100);

            $product = Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'short_description' => $productData['short_desc'],
                'description' => $productData['desc'],
                'price' => $productData['price'],
                'discount' => $productData['discount'],
                'discount_price' => round($discountPrice, 2),
                'stock' => $productData['stock'],
                'sku' => $productData['sku'],
                'low_stock_alert' => 5,
                'status' => 'published',
                'is_popular' => in_array('is_popular', $productData['flags']),
                'is_trending' => in_array('is_trending', $productData['flags']),
                'is_bestseller' => in_array('is_bestseller', $productData['flags']),
                'is_featured' => in_array('is_featured', $productData['flags']),
                'is_new_arrival' => in_array('is_new_arrival', $productData['flags']),
                'meta_title' => $productData['name'] . ' | Buy Now',
                'meta_keywords' => strtolower(str_replace(' ', ', ', $productData['name'])),
                'meta_description' => $productData['short_desc'],
                'brand_id' => $brand->id,
                'category_id' => $category->id,
                'sub_category_id' => $subCategory?->id,
            ]);

            // Create product images from available folder images
            $imageCount = rand(2, 4);
            if (!empty($availableImages)) {
                $selectedImages = Arr::random($availableImages, min($imageCount, count($availableImages)));
                $selectedImages = is_array($selectedImages) ? $selectedImages : [$selectedImages];
                
                foreach ($selectedImages as $imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                    ]);
                }
            } else {
                for ($i = 1; $i <= $imageCount; $i++) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'uploads/products/product-' . $product->id . '-'.$i.'.jpg',
                    ]);
                }
            }
        }

        $this->command->info('ProductSeeder: Created ' . Product::count() . ' products successfully!');
    }
}
