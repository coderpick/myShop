<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'is_show_in_menu',
    ];

    public static function saveCategory($request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->icon = $request->icon;
        $category->is_show_in_menu = $request->is_show_in_menu;
        $category->save();
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
