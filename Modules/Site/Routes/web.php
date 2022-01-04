<?php

use Modules\Site\Http\Controllers\SiteController;

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

Route::get('/', [SiteController::class, 'home'])
    ->name('home');

Route::get('/promocoes', [SiteController::class, 'promotions'])
->name('promotions');

Route::post('/pesquisar', [SiteController::class, 'searchFlights'])
->name('search.flights');
