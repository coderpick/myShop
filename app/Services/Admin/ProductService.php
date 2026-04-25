<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\FileUploadWithResizeTrait;
use Illuminate\Support\Str;

class ProductService
{
    use FileUploadWithResizeTrait;

    /**
     * Store a new product
     */
    public function store(array $data, ?array $images = [])
    {
        $productData = $this->prepareProductData($data);
        $product = Product::create($productData);

        if (!empty($images)) {
            $this->uploadImages($product, $images);
        }

        return $product;
    }

    /**
     * Update an existing product
     */
    public function update(string $id, array $data, ?array $images = [])
    {
        $product = Product::findOrFail($id);
        $productData = $this->prepareProductData($data);
        $product->update($productData);

        if (!empty($images)) {
            $this->uploadImages($product, $images);
        }

        return $product;
    }

    /**
     * Delete a product and its images
     */
    public function delete(string $id)
    {
        $product = Product::with('images')->findOrFail($id);

        foreach ($product->images as $image) {
            $this->deleteFile($image->image_path);
        }

        return $product->delete();
    }

    /**
     * Delete a single product image
     */
    public function deleteImage(string $id)
    {
        $image = ProductImage::findOrFail($id);
        $this->deleteFile($image->image_path);
        return $image->delete();
    }

    /**
     * Prepare data for product creation/update
     */
    private function prepareProductData(array $data): array
    {
        return [
            'name' => $data['name'],
            'slug' => $data['slug'] ?? Str::slug($data['name']),
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'price' => $data['price'],
            'discount' => $data['discount'] ?? 0,
            'discount_price' => $data['discount_price'] ?? $data['price'],
            'stock' => $data['stock'],
            'sku' => $data['sku'],
            'low_stock_alert' => $data['low_stock_alert'],
            'status' => $data['status'],
            'is_popular' => isset($data['is_popular']),
            'is_trending' => isset($data['is_trending']),
            'is_bestseller' => isset($data['is_bestseller']),
            'is_featured' => isset($data['is_featured']),
            'is_new_arrival' => isset($data['is_new_arrival']),
            'meta_title' => $data['meta_title'] ?? null,
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'] ?? null,
        ];
    }

    /**
     * Handle multiple image uploads
     */
    private function uploadImages(Product $product, array $images): void
    {
        foreach ($images as $image) {
            $imagePath = $this->upload($image, 'uploads/products', false, true, 800, 800);
            if ($imagePath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    }

    /**
     * Helper to call the trait's delete method (renamed to avoid conflict with service delete)
     */
    private function deleteFile($path)
    {
        return $this->delete($path);
    }
}
