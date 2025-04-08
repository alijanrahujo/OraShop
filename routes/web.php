<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\CloseController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\DashboardController;

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
    return redirect('login');
});


Route::middleware(['auth'])->group(function () {
    Route::any('dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::post('account/deposit', [AccountController::class, 'deposit'])->name('account.deposit');
    Route::resource('account', AccountController::class);

    Route::get('accessory/sale', [AccessoryController::class, 'sale'])->name('accessory.sale');
    Route::resource('accessory', AccessoryController::class);

    Route::post('load/deposit', [LoadController::class, 'deposit'])->name('load.deposit');
    Route::resource('load', LoadController::class);

    //Close Controller
    Route::prefix('close')->group(function () {
        Route::post('account', [CloseController::class, 'account'])->name('close.account');
        Route::post('load', [CloseController::class, 'load'])->name('close.load');
        Route::post('mobile_wallet', [CloseController::class, 'mobile_wallet'])->name('close.mobile_wallet');
    });
});

require __DIR__.'/auth.php';
