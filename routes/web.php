<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return view('/login');
})->name('login');

Route::post("/login", [LoginController::class, 'login']);
Route::get("/dashboard", [DashboardController::class, 'view'])->middleware('auth');
Route::get("/reports", [ReportsController::class, 'view'])->middleware('auth');
Route::post('/dashboard/stock/reset', [DashboardController::class, 'resetStocks'])->name('stocks.reset');
Route::post('/settings/fee/update', [DashboardController::class, 'updateFee'])->name('settings.updateFee');
