<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Seller\CatalogueController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\User\RatingNReviewController;

Route::get('/', [App\Http\Controllers\Guest\CatalogueController::class, 'welcome'])->name('home');
Route::get('/catalogue', [App\Http\Controllers\Guest\CatalogueController::class, 'catalogue'])->name('catalogue');
Route::get('/catalogue/{cardID}', [App\Http\Controllers\Guest\CatalogueController::class, 'show'])->name('catalogue.show');
Route::get('/catalogue/series/{series}', [App\Http\Controllers\Guest\CatalogueController::class, 'filterBySeries'])
    ->name('catalogue.series');

// Company/About Us page route
Route::view('/company', 'pages.guest.company')->name('company');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});
Route::post('/profiles', [ProfileController::class, 'addProfile']);
Route::put('/profiles/{profileID}', [ProfileController::class, 'updateProfile']);
Route::get('/profiles/{profileID}', [ProfileController::class, 'viewProfile']);

// User Route (Nama Link untuk user)
// Ini akan jadi www.website/user/
Route::middleware(['auth', 'user_access:0'])->prefix('user')->name('user.')->group(function(){
    // home
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    // // Cart
    Route::resource('cart', App\Http\Controllers\User\CartController::class);
    Route::get('/guest/catalogue', [App\Http\Controllers\User\CartController::class, 'show'])->name('show');
    Route::delete('/cart/{id}', [App\Http\Controllers\User\CartController::class, 'destroy'])->name('remove');
    Route::put('/cart/{id}/checkout', [App\Http\Controllers\User\CartController::class, 'update'])->name('checkout');
    Route::resource('checkout', App\Http\Controllers\User\CheckoutController::class);

    // Order
    Route::resource('order', App\Http\Controllers\User\OrderController::class);
    Route::get('/order/{id}', [App\Http\Controllers\User\OrderController::class, 'show'])->name('order.show');
    Route::delete('/order/{id}', [App\Http\Controllers\User\OrderController::class, 'destroy'])->name('order.destroy');
    Route::patch('/order/{order}/received', [App\Http\Controllers\User\OrderController::class, 'markAsReceived'])->name('orders.received');

    // Checkout
    Route::get('/checkout', [App\Http\Controllers\User\CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/process/{id}', [App\Http\Controllers\User\CheckoutController::class, 'create'])
        ->name('checkout.create');
    Route::post('/checkout/process/{id}', [App\Http\Controllers\User\CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Coupon
    Route::get('/coupon', [App\Http\Controllers\CouponController::class, 'index'])->name('coupon.index');
    Route::post('/coupon/apply', [App\Http\Controllers\CouponController::class, 'apply'])->name('coupon.apply');
    Route::get('/coupon/create', [App\Http\Controllers\CouponController::class, 'create'])->name('coupon.create');
    Route::post('/coupon', [App\Http\Controllers\CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/{coupon}', [App\Http\Controllers\CouponController::class, 'show'])->name('coupon.show');
    Route::put('/coupon/{coupon}', [App\Http\Controllers\CouponController::class, 'update'])->name('coupon.update');
    Route::delete('/coupon/{coupon}', [App\Http\Controllers\CouponController::class, 'destroy'])->name('coupon.destroy');
    // Feedback
    Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

    // Rating and Reviews
    Route::get('/reviews', [App\Http\Controllers\User\RatingNReviewController::class, 'index'])->name('review.index');
    Route::get('/reviews/create', [App\Http\Controllers\User\RatingNReviewController::class, 'create'])->name('review.create');
    Route::post('/reviews', [App\Http\Controllers\User\RatingNReviewController::class, 'store'])->name('review.store');
    Route::delete('/reviews/{review}', [App\Http\Controllers\User\RatingNReviewController::class, 'destroy'])->name('review.destroy');
    Route::get('/reviews/modal/{cardId}', [App\Http\Controllers\User\RatingNReviewController::class, 'showModal'])->name('review.modal');
});

// Seller Route (Nama Link untuk seller)
Route::middleware(['auth', 'user_access:1'])->prefix('seller')->name('seller.')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('dashboard');
    
    // Replace the simple resource route with explicit routes
    Route::get('/catalogue', [App\Http\Controllers\Seller\CatalogueController::class, 'index'])->name('catalogue.index');
    Route::get('/catalogue/create', [App\Http\Controllers\Seller\CatalogueController::class, 'create'])->name('catalogue.create');
    Route::post('/catalogue', [App\Http\Controllers\Seller\CatalogueController::class, 'store'])->name('catalogue.store');
    Route::get('/catalogue/{card}', [App\Http\Controllers\Seller\CatalogueController::class, 'show'])->name('catalogue.show');
    Route::get('/catalogue/{card}/edit', [App\Http\Controllers\Seller\CatalogueController::class, 'edit'])->name('catalogue.edit');
    Route::put('/catalogue/{card}', [App\Http\Controllers\Seller\CatalogueController::class, 'update'])->name('catalogue.update');
    Route::delete('/catalogue/{card}', [App\Http\Controllers\Seller\CatalogueController::class, 'destroy'])->name('catalogue.destroy');
    Route::patch('/cards/{card}/stock', [CatalogueController::class, 'updateStock'])
        ->name('seller.cards.updateStock');

    // Coupon management routes
    Route::get('/coupons', [App\Http\Controllers\Seller\CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [App\Http\Controllers\Seller\CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [App\Http\Controllers\Seller\CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [App\Http\Controllers\Seller\CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [App\Http\Controllers\Seller\CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [App\Http\Controllers\Seller\CouponController::class, 'destroy'])->name('coupons.destroy');
    Route::get('/coupons/{coupon}/assign', [App\Http\Controllers\Seller\CouponController::class, 'showAssignForm'])->name('coupons.assign.form');
    Route::post('/coupons/{coupon}/assign', [App\Http\Controllers\Seller\CouponController::class, 'assignToUser'])->name('coupons.assign');

    // Order management routes
    Route::get('/orders', [App\Http\Controllers\Seller\OrderController::class, 'index'])->name('order.index');
    Route::patch('/orders/{order}/approve', [App\Http\Controllers\Seller\OrderController::class, 'approve'])->name('order.approve');
    Route::delete('/orders/{order}', [App\Http\Controllers\Seller\OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/orders/{order}', [App\Http\Controllers\Seller\OrderController::class, 'show'])->name('order.show');
    Route::patch('/orders/{order}/tracking', [App\Http\Controllers\Seller\OrderController::class, 'updateTracking'])->name('order.tracking.update');

    Route::get('/feedback', [App\Http\Controllers\Seller\FeedbackController::class, 'index'])->name('feedback.index');
    
});

// Admin Route (Nama Link untuk admin)
Route::middleware(['auth', 'user_access:2'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add this route in your web.php file
Route::get('/order/{order}/cancel', [OrderController::class, 'cancel'])->name('user.order.cancel');

Route::patch('/seller/orders/{id}/approve', [OrderController::class, 'approve'])->name('seller.order.approve');

// Add these routes in the authenticated group
Route::middleware(['auth', 'web'])->group(function () {
    Route::post('/api/coupons/{coupon}/apply', [CouponController::class, 'apply'])
        ->name('api.coupons.apply')
        ->middleware('web');
    Route::post('/api/orders/{order}/remove-coupon', [CouponController::class, 'removeCoupon'])
        ->name('api.orders.remove-coupon')
        ->middleware('web');
});

require __DIR__.'/auth.php';
