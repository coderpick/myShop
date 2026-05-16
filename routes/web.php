<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SslCommerzPaymentController;
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
    /* order manage route */

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('order/{id}/invoice', [OrderController::class, 'generateInvoice'])->name('order.generateInvoice');

    /* customer */
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::delete('customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});

/* get subcategory by category id start */

Route::get('get-subcategories-by-category', [AjaxController::class, 'getSubcategoriesByCategory'])->name('getSubCategories');

/* product quick view route */
Route::get('product-quick-view/{id}', [AjaxController::class, 'getProductQuickView'])->name('product.quickView');

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
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/store', [CheckoutController::class, 'store'])->name('store');
});

// SSLCommerz routes
Route::controller(SslCommerzPaymentController::class)
    ->prefix('sslcommerz')
    ->name('sslc.')
    ->group(function () {
        Route::post('success', 'success')->name('success');
        Route::post('failure', 'failure')->name('failure');
        Route::post('cancel', 'cancel')->name('cancel');
        Route::post('ipn', 'ipn')->name('ipn');
    });

/* customer dashboard */
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile/update', [App\Http\Controllers\CustomerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/order/{id}', [App\Http\Controllers\CustomerDashboardController::class, 'orderDetails'])->name('order.details');
    Route::get('/order/{id}/invoice', [App\Http\Controllers\CustomerDashboardController::class, 'downloadInvoice'])->name('order.invoice');
});
