<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('product/{slug}', ProductDetailController::class)->name('product.show');
Route::get('category/{category?}', ShopController::class)->name('shop');

/* user authentication routs */
Auth::routes();

/* admin routs */

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('sub_category', SubCategoryController::class)->except('show');
    Route::resource('brand', BrandController::class)->except('show');
    Route::resource('product', ProductController::class);
    Route::delete('product-image-delete', [ProductController::class, 'deleteImage'])->name('product-image.destroy');

});

/* get subcategory by category id start */

Route::get('get-subcategories-by-category', [AjaxController::class, 'getSubcategoriesByCategory'])->name('getSubCategories');
