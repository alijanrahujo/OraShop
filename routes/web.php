<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POScontroller;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CloseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
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
    Route::any('dashboard',[DashboardController::class, 'dashboard2'])->name('dashboard');

    Route::get('accessory/sale', [AccessoryController::class, 'sale'])->name('accessory.sale');
    Route::resource('accessory', AccessoryController::class);
    Route::resource('pos', POScontroller::class);

    Route::get('report/stock',[ReportController::class,'stock'])->name('report.stock');
    Route::get('close/sell',[CloseController::class,'sellClose'])->name('report.sellClose');
    Route::post('close/closestore',[CloseController::class,'closestore'])->name('sale.closestore');

    Route::post('account/deposit', [AccountController::class, 'deposit'])->name('account.deposit');
    Route::resource('account', AccountController::class);

    Route::post('load/deposit', [LoadController::class, 'deposit'])->name('load.deposit');
    Route::resource('load', LoadController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('category', CategoryController::class);

    Route::post('shop/change', [ShopController::class, 'change'])->name('shop.change');


    //Reports
    Route::get('report.sale',[ReportController::class,'saleReport'])->name('report.sale');
    Route::get('report.account',[ReportController::class,'accountReport'])->name('report.account');
    Route::get('report.load',[ReportController::class,'loadReport'])->name('report.load');
    Route::get('report.purchase',[ReportController::class,'purchaseReport'])->name('report.purchase');
    Route::get('report.balance',[ReportController::class,'balanceReport'])->name('report.balance');
    Route::get('report.saleClose',[ReportController::class,'saleCloseReport'])->name('report.saleClose');

    //Close Controller
    Route::prefix('close')->group(function () {
        Route::post('account', [CloseController::class, 'account'])->name('close.account');
        Route::post('load', [CloseController::class, 'load'])->name('close.load');
        Route::post('mobile_wallet', [CloseController::class, 'mobile_wallet'])->name('close.mobile_wallet');
    });
});

require __DIR__.'/auth.php';
