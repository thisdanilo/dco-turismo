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

Route::group(['middleware' => 'auth'], function(){

    Route::get('/detalhes-voo/{id}', [SiteController::class, 'flightDetails'])
    ->name('flight.details');

    Route::post('/reservar-voo', [SiteController::class, 'reserveFlight'])
    ->name('reserve.flight');

    Route::get('/minhas-compras', [SiteController::class, 'purchases'])
    ->name('purchases');

    Route::get('/detalhe-compra/{id}', [SiteController::class, 'purchaseDetails'])
    ->name('purchase.details');

    Route::get('/meu-perfil', [SiteController::class, 'myProfile'])
    ->name('my.profile');

    Route::post('/atualizar-perfil', [SiteController::class, 'updateProfile'])
    ->name('update.profile');

    Route::get('/sair', [SiteController::class, 'logout'])
    ->name('logout');

});
