<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('product/{slug}', ProductDetailController::class)->name('product.show');
Route::get('shop', [ShopController::class, 'index'])->name('shop');
Route::get('category/{slug}', [ShopController::class, 'index'])->name('shop.category');
Route::get('subcategory/{slug}', [ShopController::class, 'index'])->name('shop.subcategory');
Route::get('brand/{slug}', [ShopController::class, 'index'])->name('shop.brand');

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

/* cart routes */
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'getCart'])->name('index');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('count');
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::post('/update', [CartController::class, 'updateCart'])->name('update');
    Route::post('/remove', [CartController::class, 'removeFromCart'])->name('remove');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('clear');
});

/* checkout routes */
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/{step?}', [CheckoutController::class, 'step'])->name('step');
    Route::post('/submit-step/{step}', [CheckoutController::class, 'submitStep'])->name('submit-step');
    Route::get('/payment/{orderId}', [CheckoutController::class, 'payment'])->name('payment');
    Route::post('/payment/{orderId}', [CheckoutController::class, 'processPayment'])->name('process-payment');
    Route::get('/success/{orderId}', [CheckoutController::class, 'success'])->name('success');
});
