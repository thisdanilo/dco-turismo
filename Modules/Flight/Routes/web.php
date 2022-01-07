<?php

use Modules\Flight\Http\Controllers\FlightController;

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

Route::group(
    [
        'middleware' => ['auth', 'admin'],
        'prefix' => 'dashboard/flight',
        'as' => 'flight.'
    ],
    function () {
        Route::get('/', [FlightController::class, 'index'])
            ->name('index');

        Route::post('/datatable', [FlightController::class, 'dataTable'])
            ->name('datatable');

        Route::get('/{id}/ver', [FlightController::class, 'show'])
            ->name('show');

        Route::get('/cadastrar', [FlightController::class, 'create'])
            ->name('create');

        Route::post('/cadastrar', [FlightController::class, 'store'])
            ->name('store');

        Route::get('/{id}/editar', [FlightController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}/editar', [FlightController::class, 'update'])
            ->name('update');

        Route::get('/{id}/confirmar-exclusao', [FlightController::class, 'confirmDelete'])
            ->name('confirm_delete');

        Route::delete('/{id}/excluir', [FlightController::class, 'delete'])
            ->name('delete');
    }
);
