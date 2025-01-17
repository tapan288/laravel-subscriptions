<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProtectedController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\RedirectIfNotSubscribed;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('plans', [PlanController::class, 'index'])
    ->name('plans');

Route::get('checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', [SubscriptionController::class, 'index'])->name('subscription');
        Route::get('/portal', [SubscriptionController::class, 'portal'])->name('subscription.portal');
    });
    Route::get('protected', [ProtectedController::class, 'index'])
        ->middleware(RedirectIfNotSubscribed::class)
        ->name('protected');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
