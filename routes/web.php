<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StoreController::class, 'showCustomDomain']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// guest routes
Route::get('/stores/{url}', [StoreController::class, 'show']);
Route::post('/applyCoupon', [CouponController::class, 'applyCoupon']);


// super Admin routes
Route::group(['middleware' => ['auth', 'isSuperAdmin']], function () {
    Route::get('/superAdmin', [SuperAdminController::class, 'showDashboard']);
    Route::get('/superAdmin/stores', [StoreController::class, 'index'])->name('superAdminStores');
    Route::post('/superAdmin/stores/suspend/{id}', [StoreController::class, 'suspendStore'])->name('suspendStore');
    Route::post('/superAdmin/stores/unSuspend/{id}', [StoreController::class, 'unSuspendStore'])->name('unSuspendStore');
    Route::post('/superAdmin/stores/deleteStore/{id}', [StoreController::class, 'destroy'])->name('deleteStore');
    Route::get('/superAdmin/stores/add', [StoreController::class, 'create'])->name('addStore');
    Route::post('/superAdmin/stores/create', [StoreController::class, 'store'])->name('createStore');
    Route::get('superAdmin/stores/searchStores', [StoreController::class, 'searchStores'])->name('searchStores');
    Route::post('superAdmin/stores/editCustomDomain', [StoreController::class, 'editCustomDomain'])->name('editCustomDomain');
});

Route::group(['middleware' => ['auth', 'notSuperAdmin']], function () {
    Route::get('/admin', [AdminController::class, 'showDashboard']);
    Route::get('/admin/editStore', [StoreController::class, 'edit'])->name('adminEditStore');
    Route::post('/admin/updateStore', [StoreController::class, 'update'])->name('adminUpdateStore');
    Route::post('/admin/addDeliveryPlace', [AdminController::class, 'addDeliveryPlace'])->name('adminAddPlace');
    Route::post('/admin/deleteDeliveryPlace/{id}', [AdminController::class, 'deleteDeliveryPlace'])->name('adminDeletePlace');

    Route::resource('admin/categories', ProductCategoryController::class, [
        'as' => 'admin'
    ]);
    Route::get('/admin/categories/toggleActivation/{id}', [ProductCategoryController::class, 'toggleActivation'])->name('toggleActivationCategory');
    Route::post('/admin/categories/searchCategories', [ProductCategoryController::class, 'searchCategories'])->name('adminSearchCategories');
    
    
    Route::resource('admin/products', ProductController::class, [
        'as' => 'admin'
    ]);
    Route::get('/admin/products/toggleActivation/{id}', [ProductController::class, 'toggleActivation'])->name('toggleActivationProduct');
    Route::post('admin/products/searchProducts', [ProductController::class, 'searchProducts'])->name('adminSearchProducts');

    Route::resource('admin/coupons', CouponController::class, [
        'as' => 'admin'
    ]);
    Route::post('admin/coupons/searchCoupons', [CouponController::class, 'searchCoupons'])->name('searchCoupons');
});
