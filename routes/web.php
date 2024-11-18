<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'ensureuserinfo'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('complete-profile', [CompleteProfileController::class, 'create'])
    ->name('completeprofile')
    ->middleware('auth');

Route::post('complete-profile', [CompleteProfileController::class, 'store'])->middleware('auth');



Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/help', [PageController::class, 'help'])->name('help');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

Route::get('/order-food', [RestaurantController::class, 'orderFood'])->name('order.food');
Route::get('/search-restaurant', [RestaurantController::class, 'searchRestaurant'])->name('search.restaurant');
Route::get('/submit-restaurant', [RestaurantController::class, 'submit'])->name('restaurant.add');

Route::get('/register', [PageController::class, 'register'])->name('account.register');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/categories/top', [PageController::class, 'topCategories'])->name('categories.top');
Route::get('/categories/best-rated', [PageController::class, 'bestRated'])->name('categories.best-rated');
Route::get('/categories/best-price', [PageController::class, 'bestPrice'])->name('categories.best-price');
Route::get('/categories/latest', [PageController::class, 'latestSubmissions'])->name('categories.latest');

require __DIR__ . '/auth.php';
