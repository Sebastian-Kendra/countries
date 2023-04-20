<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

/* 
// Home
*/
Route::get('/{any?}', [PageController::class, 'home'])->where('any', '.*'); //where any .* is literally anything

/* 
// Continent Controller
*/
Route::resource('continents', 'App\Http\Controllers\ContinentController');

/* 
// Country Controller
*/
Route::resource('countries', 'App\Http\Controllers\CountryController');