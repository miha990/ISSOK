<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetShopController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('petshops', PetShopController::class);
