<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestmentController;

Route::get('/', function () {
    return redirect()->route('startups.index');
});

Route::resource('startups', StartupController::class);
Route::resource('investors', InvestorController::class);
Route::resource('investments', InvestmentController::class);

Route::patch('investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('investments.approve');
Route::patch('investments/{investment}/reject', [InvestmentController::class, 'reject'])->name('investments.reject');
