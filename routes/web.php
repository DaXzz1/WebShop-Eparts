<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\PartCategoriesController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Pluralizer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get("/", function () {
    return view("home");
});

Route::get("language/{locale}", [Controller::class, 'toggleLanguage'])->name("language");

Route::get("/search", [SearchController::class, 'index'])->name("search.index");

Route::get("/cart", [CartController::class, "index"])->name("cart.index");
Route::post("/cart/clear", [CartController::class, "clear"])->name("cart.clear");
Route::post("/cart/{part:id}/add", [CartController::class, "add"])->name("cart.add");
Route::put("/cart/{part:id}/increment", [CartController::class, "increment"])->name("cart.increment");
Route::put("/cart/{part:id}/decrement", [CartController::class, "decrement"])->name("cart.decrement");
Route::put("/cart/{part:id}/update", [CartController::class, "updateCount"])->name("cart.count.update");
Route::delete("/cart/{part:id}/remove", [CartController::class, "remove"])->name("cart.remove");

Route::get("/checkout", [StripeController::class, "index"])->name("stripe.index");
Route::post("/checkout", [StripeController::class, "checkout"])->name("stripe.checkout");
Route::post("/webhook", [StripeController::class, "webhook"])->name("stripe.webhook");
Route::get("/success", [StripeController::class, "success"])->name("stripe.success");

Route::get("/my-profile", [ProfileController::class, "index"])->name("profile.index");
Route::put("/my-profile", [ProfileController::class, "update"])->name("profile.save");
Route::get("/my-orders", [ProfileController::class, "orders"])->name("profile.orders");
Route::post("/delete-orders", [ProfileController::class, "ignoreAllOrders"])->name("profile.orders.deleteAll");
Route::post("/delete-orders/{order:id}", [ProfileController::class, "ignoreOrder"])->name("profile.order.delete");

Route::get("/", [CarsController::class, "index"])->name("home");
Route::get("/{car:slug}", [ModelsController::class, "index"])->name("car.models");
Route::get("/{car:slug}/{model:slug}/modification/{modification:id?}", [PartCategoriesController::class, "index"])->name("car.parts")->whereNumber("modification");
Route::get("/{car:slug}/{model:slug}/{category:slug}/{id?}", [PartsController::class, "index"])->name("car.parts.byCategory")->whereNumber("id");
Route::get("/{car:slug}/{model:slug}/{category:slug}/part/{part:id}/{modification:id?}", [PartsController::class, "show"])->name("car.parts.show");
