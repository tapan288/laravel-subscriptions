<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProtectedController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\RedirectIfCancelled;
use App\Http\Middleware\RedirectIfNotCancelled;
use App\Http\Middleware\RedirectIfNotSubscribed;
use App\Http\Middleware\RedirectIfSubscribed;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('plans', [PlanController::class, 'index'])
    ->middleware(RedirectIfSubscribed::class)
    ->name('plans');

Route::get('checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::middleware('auth')->group(function () {
    Route::post('resume', [SubscriptionController::class, 'resume'])
        ->middleware([RedirectIfNotCancelled::class])
        ->name('subscription.resume');

    Route::post('cancel', [SubscriptionController::class, 'cancel'])
        ->middleware([RedirectIfCancelled::class])
        ->name('subscription.cancel');

    Route::get('invoice', [SubscriptionController::class, 'invoice'])->name('invoice.download');

    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', [SubscriptionController::class, 'index'])->name('subscription');
        Route::get('/portal', [SubscriptionController::class, 'portal'])
            ->middleware(RedirectIfNotSubscribed::class)
            ->name('subscription.portal');
    });
    Route::get('protected', [ProtectedController::class, 'index'])
        ->middleware(RedirectIfNotSubscribed::class)
        ->name('protected');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
