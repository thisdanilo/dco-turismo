<?php

use Modules\Bland\Http\Controllers\BlandController;

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
        'prefix' => 'dashboard/bland',
        'as' => 'bland.'
    ],
    function () {

        Route::get('/', [BlandController::class, 'index'])
            ->name('index');

        Route::post('/datatable', [BlandController::class, 'dataTable'])
            ->name('datatable');

        Route::get('/{id}/ver', [BlandController::class, 'show'])
            ->name('show');

        Route::get('/cadastrar', [BlandController::class, 'create'])
            ->name('create');

        Route::post('/cadastrar', [BlandController::class, 'store'])
            ->name('store');

        Route::get('/{id}/editar', [BlandController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}/editar', [BlandController::class, 'update'])
            ->name('update');

        Route::get('/{id}/confirmar-exclusao', [BlandController::class, 'confirmDelete'])
            ->name('confirm_delete');

        Route::delete('/{id}/excluir', [BlandController::class, 'delete'])
            ->name('delete');
    }
);
