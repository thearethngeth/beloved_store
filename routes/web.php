<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use App\Http\Controllers\ProductsManager;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsManager::class,"index"])->name("home");

Route::get("login", [AuthManager::class , "login"])
    ->name("login");

Route::get("logout", [AuthManager::class , "logout"])
    ->name("logout");

Route::post("login", [AuthManager::class , "loginPost"])
    ->name("login.post");

Route::get("register", [AuthManager::class , "register"])
    ->name("register");

Route::post("register", [AuthManager::class , "registerPost"])
    ->name("register.post");

Route::get("/product/{slug}", [ProductsManager::class,"details"])
    ->name("products.details");

Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get("/profile", [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/photo/upload', [ProfileController::class, 'uploadPhoto'])->name('profile.photo.upload');
    Route::delete('/profile/photo/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');

    Route::get("/cart/add/{id}", [ProductsManager::class,"addToCart"])
        ->name("cart.add");

    Route::get("/cart", [ProductsManager::class,"showCart"])
        ->name("cart.show");

    Route::post("/cart/remove/{productId}", [ProductsManager::class,"removeFromCart"])
        ->name("cart.remove");

    Route::post("/cart/clear", [ProductsManager::class,"clearCart"])
        ->name("cart.clear");

    Route::get("/checkout", [OrderManager::class,"showCheckout"])
        ->name("checkout.show");

    Route::post("/checkout", [OrderManager::class,"checkoutPost"])
        ->name("checkout.post");

    Route::get("/orders", [OrderManager::class,"myOrders"])
        ->name("orders.index");

    Route::get("/orders/{id}", [OrderManager::class,"orderDetails"])
        ->name("orders.details");
});
Route::get("/payment/success/{order_id}", [OrderManager::class,"paymentSuccess"])
    ->name("payment.success");

Route::get("/payment/error", [OrderManager::class,"paymentError"])
    ->name("payment.error");
