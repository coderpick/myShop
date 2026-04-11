<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'discount',
        'discount_price',
        'stock',
        'status',
        'is_popular',
        'is_trending',
        'is_bestseller',
        'is_featured',
        'view_count',
        'brand_id',
        'category_id',
        'sub_category_id',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function reviews()
    {
        
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
