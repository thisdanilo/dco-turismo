<?php

use Modules\Reserve\Http\Controllers\ReserveController;

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
        'prefix' => 'dashboard/reserve',
        'as' => 'reserve.'
    ],
    function () {

        Route::get('/', [ReserveController::class, 'index'])
            ->name('index');

        Route::post('/datatable', [ReserveController::class, 'dataTable'])
            ->name('datatable');

        Route::get('/{id}/ver', [ReserveController::class, 'show'])
            ->name('show');

        Route::get('/cadastrar', [ReserveController::class, 'create'])
            ->name('create');

        Route::post('/cadastrar', [ReserveController::class, 'store'])
            ->name('store');

        Route::get('/{id}/editar', [ReserveController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}/editar', [ReserveController::class, 'update'])
            ->name('update');

        Route::get('/{id}/confirmar-exclusao', [ReserveController::class, 'confirmDelete'])
            ->name('confirm_delete');

        Route::delete('/{id}/excluir', [ReserveController::class, 'delete'])
            ->name('delete');
    }
);
