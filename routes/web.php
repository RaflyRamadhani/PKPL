<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\OrderHistoryController;

// Halaman Utama - Redirect ke login
Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke halaman login
});

// Rute otentikasi
Auth::routes();

// Rute dashboard untuk pengguna yang terautentikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('dashboard');

// Rute Admin
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
            Route::get('/manage/stores', 'manage_stores')->name('admin.manage.stores');
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history');
            Route::get('/order/history', 'order_history')->name('admin.order.history');
        });


        // Rute untuk Category
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create', 'index')->name('category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });

        // Rute untuk Product
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/manage', 'index')->name('product.manage');
            Route::get('/product/review/manage', 'review_manage')->name('product.review.manage');
        });

        // Rute untuk Product Attribute
        Route::controller(ProductAttributeController::class)->group(function () {
            Route::get('/productattribute/create', 'index')->name('productattribute.create');
            Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');
        });

        // Rute untuk Product Discount
        Route::controller(ProductDiscountController::class)->group(function () {
            Route::get('/discount/create', 'index')->name('discount.create');
            Route::get('/discount/manage', 'manage')->name('discount.manage');
        });

        // Rute untuk MasterCategory
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::get('/category/show/{id}', 'showcat')->name('category.show');
            Route::delete('/category/delete/{id}', 'deletecat')->name('category.delete');
            Route::post('/store/category', 'storecat')->name('store.cat');
            Route::put('/admin/category/update/{id}', 'updatecat')->name('update.cat');
        });
    });
});

// Rute Vendor
Route::get('vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified', 'rolemanager:vendor'])->name('vendor');

// Rute Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Tambahan
Route::post('/admin/category/buy/{id}', [CategoryController::class, 'buy'])->name('category.buy');
Route::get('/admin/category/payment-selection/{id}', [CategoryController::class, 'paymentSelection'])->name('category.payment.selection');
Route::post('/admin/category/payment/process/{id}', [CategoryController::class, 'processPayment'])->name('payment.process');
Route::get('/admin/category/manage', [CategoryController::class, 'manage'])->name('category.manage');
Route::get('/admin/order/history', [OrderHistoryController::class, 'index'])->name('admin.order.history');
Route::delete('/admin/order/history/{id}', [OrderHistoryController::class, 'destroy'])->name('order.history.delete');

Route::get('/admin/category/payment-selection/{id}', [CategoryController::class, 'paymentSelection'])->name('category.payment.selection');
Route::post('/admin/category/payment/process/{id}', [CategoryController::class, 'processPayment'])->name('payment.process');

// Rute Logout dengan redirect
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth')
    ->uses(function () {
        Auth::logout(); // Log out pengguna
        return redirect()->route('login'); // Redirect ke halaman login
    });

// Menggunakan rute tambahan untuk otentikasi
require __DIR__.'/auth.php';
