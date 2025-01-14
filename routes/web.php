<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

// Processar formulário de checkout
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Exibir página de confirmação
Route::get('/confirm-checkout', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

use App\Http\Controllers\PaymentController;

Route::post('/process-payment', [PaymentController::class, 'process'])->name('payment.process');


require __DIR__.'/auth.php';
