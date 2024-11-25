<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

Route::get('/merchants', [MerchantController::class, 'homeindex'])->name('merchants.home.index');
Route::get('/merchants/{merchant}', [MerchantController::class, 'homeshow'])->name('merchants.show');

Route::get('/register-merchant', [MerchantController::class, 'registerForm'])->name('merchant.register');
Route::post('/register-merchant', [MerchantController::class, 'register'])->name('merchant.store');

Route::middleware('ensureuserinfo')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('topup')->group(function () {
            Route::post('/generate', [WalletController::class, 'generateQrCode'])->name('topup.generate');
            Route::get('/process/{reference}', [WalletController::class, 'processTopup'])->name('topup.process');
        });

        Route::get('/payment/qr/{reference}', [WalletController::class, 'generatePaymentQr'])->name('payment.qr');

        Route::get('/transactions', [WalletController::class, 'getTransactions'])->name('transactions');

        Route::prefix('cart')->middleware('auth')->group(function () {
            Route::get('/', [OrderController::class, 'viewCart'])->name('cart.view');
            Route::post('/add', [OrderController::class, 'addToCart'])->name('cart.add');
        });

        Route::prefix('customer')->middleware(['role:customer'])->group(function () {
            Route::get('/orders', [OrderController::class, 'customerOrders'])->name('customer.orders.index');
            Route::get('/orders/{order}', [OrderController::class, 'customerOrderDetail'])->name('customer.orders.show');
            Route::post('/orders/{order}/review', [OrderController::class, 'review'])->name('customer.orders.review');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
});

// Merchant Management Routes
Route::prefix('admin/merchants')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [MerchantController::class, 'index'])->name('admin.merchants.index'); // List merchants
    Route::get('/{id}', [MerchantController::class, 'show'])->name('admin.merchants.show'); // Show merchant details
    Route::post('/{id}/accept', [MerchantController::class, 'accept'])->name('admin.merchants.accept'); // Accept merchant
    Route::post('/{id}/reject', [MerchantController::class, 'reject'])->name('admin.merchants.reject'); // Reject merchant
});

// Admin General Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users'); // Display user management page
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store'); // Add user
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update'); // Update user
    Route::get('/users/{user}/transactions', [AdminController::class, 'userTransactions'])->name('admin.users.transactions'); // Fetch user transactions
    Route::post('/merchants/{merchant}/status', [AdminController::class, 'updateMerchantStatus'])->name('admin.merchant.status'); // Update merchant status
});


Route::prefix('merchant')->middleware(['auth', 'role:merchant'])->group(function () {
    Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('merchant.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('merchant.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('merchant.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('merchant.products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('merchant.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('merchant.products.destroy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'merchantOrders'])->name('merchant.orders.index');
        Route::get('/{order}', [OrderController::class, 'merchantOrderDetail'])->name('merchant.orders.show');
        Route::post('/{order}/update-status', [OrderController::class, 'updateOrderStatus'])->name('merchant.orders.update-status');
    });
});

require __DIR__ . '/auth.php';
