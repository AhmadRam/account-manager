<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ReportController;

// توجيه الصفحة الرئيسية إلى تسجيل الدخول أو قائمة الأشخاص
Route::get('/', function () {
    return auth()->check() ? redirect()->route('people.index') : redirect()->route('login');
});

// Routes المصادقة
Auth::routes(['register' => false]); // إزالة تسجيل مستخدم جديد

// Routes محمية بالمصادقة
Route::middleware('auth')->group(function () {
    // Routes للأشخاص
    Route::resource('people', PersonController::class);

    // Routes للمعاملات
    Route::post('people/{person}/transactions', [TransactionController::class, 'store'])
         ->name('transactions.store');

    // Routes للعملات
    Route::resource('currencies', CurrencyController::class);
    
    // Routes للتقارير
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});
