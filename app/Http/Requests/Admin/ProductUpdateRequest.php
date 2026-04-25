<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $productId = $this->route('product');

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $productId,
            'short_description' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|max:99',
            'discount_price' => 'nullable|numeric',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $productId,
            'stock' => 'required|integer|min:0',
            'low_stock_alert' => 'required|integer|min:0',
            'category_id' => 'required|integer|min:0|exists:categories,id',
            'sub_category_id' => 'nullable|integer|min:0|exists:sub_categories,id',
            'brand_id' => 'required|integer|min:0|exists:brands,id',
            'status' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:200',
            'is_popular' => 'nullable',
            'is_trending' => 'nullable',
            'is_bestseller' => 'nullable',
            'is_featured' => 'nullable',
            'is_new_arrival' => 'nullable',
        ];
    }
}
