<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Restaurants\GetRestaurantsListController;
use App\Http\Controllers\Api\Restaurants\ShowRestaurantController;

Route::get('/restaurants', GetRestaurantsListController::class)->name('restaurants.list');
Route::get('/restaurants/{id}', ShowRestaurantController::class)->name('restaurants.show');
