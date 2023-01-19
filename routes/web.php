<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::group(['middleware' => ['auth', 'notSuperAdmin']], function () {
    Route::get('/admin', [AdminController::class, 'showDashboard']);
    Route::get('/admin/editStore', [StoreController::class, 'edit'])->name('adminEditStore');
    Route::post('/admin/updateStore', [StoreController::class, 'update'])->name('adminUpdateStore');
    Route::post('/admin/addDeliveryPlace', [AdminController::class, 'addDeliveryPlace'])->name('adminAddPlace');
    Route::post('/admin/deleteDeliveryPlace/{id}', [AdminController::class, 'deleteDeliveryPlace'])->name('adminDeletePlace');

    Route::get('/admin/categories', [ProductCategoryController::class, 'index'])->name('adminCategories');
    Route::post('/admin/categories/searchCategories', [ProductCategoryController::class, 'searchCategories'])->name('adminSearchCategories');
    Route::post('/admin/categories/deleteCategory/{id}', [ProductCategoryController::class, 'destroy'])->name('deleteCategory');
    Route::post('/admin/categories/updateCategory/{id}', [ProductCategoryController::class, 'update'])->name('adminUpdateCategory');
    Route::get('/admin/categories/createCategory', [ProductCategoryController::class, 'create'])->name('adminCreateCategory');
    Route::post('/admin/categories/storeCategory', [ProductCategoryController::class, 'store'])->name('adminStoreCategory');
    Route::get('/admin/categories/toggleActivation/{id}', [ProductCategoryController::class, 'toggleActivation'])->name('toggleActivationCategory');

    Route::get('admin/products', [ProductController::class, 'index'])->name('adminProducts');
    Route::post('admin/products/searchProducts', [ProductController::class, 'searchProducts'])->name('adminSearchProducts');
    Route::post('admin/products/deleteProduct/{id}', [ProductController::class, 'destroy'])->name('adminDeleteProduct');
    Route::get('admin/products/editProduct/{id}', [ProductController::class, 'edit'])->name('adminEditProduct');
    Route::post('admin/products/updateProduct/{id}', [ProductController::class, 'update'])->name('adminUpdateProduct');
    Route::get('/admin/products/createProduct', [ProductController::class, 'create'])->name('adminCreateProduct');
    Route::post('/admin/products/storeProduct', [ProductController::class, 'store'])->name('adminStoreProduct');
    Route::get('/admin/products/toggleActivation/{id}', [ProductController::class, 'toggleActivation'])->name('toggleActivationProduct');

});
