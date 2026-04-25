<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|max:99',
            'discount_price' => 'nullable|numeric',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'low_stock_alert' => 'required|integer|min:0',
            'category_id' => 'required|integer|min:0|exists:categories,id',
            'sub_category_id' => 'nullable|integer|min:0|exists:sub_categories,id',
            'brand_id' => 'required|integer|min:0|exists:brands,id',
            'status' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
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

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Product name is required',
    //         'slug.required' => 'Product slug is required',
    //         'short_description.required' => 'Product short description is required',
    //         'description.required' => 'Product description is required',
    //         'price.required' => 'Product price is required',
    //         'discount.required' => 'Product discount is required',
    //         'discount_price.required' => 'Product discount price is required',
    //         'images.required' => 'Product images are required',
    //         'images.*.required' => 'Product image is required',
    //         'images.*.image' => 'Product image must be an image',
    //         'images.*.mimes' => 'Product image must be a jpeg,png,jpg,webp',
    //         'images.*.max' => 'Product image must be less than 5MB',
    //         'meta_title.required' => 'Product meta title is required',
    //         'meta_description.required' => 'Product meta description is required',
    //         'meta_keywords.required' => 'Product meta keywords is required',
    //     ];
    // }
}
