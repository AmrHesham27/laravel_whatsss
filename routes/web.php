<?php

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

Route::get('/stores/{id}', [StoreController::class, 'show']);


// super Admin routes
Route::group(['middleware' => ['auth', 'isSuperAdmin']], function () {
    Route::get('/superAdmin', [SuperAdminController::class, 'showDashboard']);
    Route::get('/superAdmin/stores', [SuperAdminController::class, 'showAllStores'])->name('superAdminStores');
    Route::post('/superAdmin/stores/suspend/{id}', [SuperAdminController::class, 'suspendStore'])->name('suspendStore');
    Route::post('/superAdmin/stores/unSuspend/{id}', [SuperAdminController::class, 'unSuspendStore'])->name('unSuspendStore');
    Route::post('/superAdmin/stores/deleteStore/{id}', [SuperAdminController::class, 'deleteStore'])->name('deleteStore');
    Route::get('/superAdmin/stores/add', [SuperAdminController::class, 'addStore'])->name('addStore');
    Route::post('/superAdmin/stores/create', [SuperAdminController::class, 'createStore'])->name('createStore');
});

Route::group(['middleware' => ['auth', 'notSuperAdmin']], function () {
    Route::get('/admin', [SuperAdminController::class, 'showDashboard']);
});
