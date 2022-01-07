<?php

use Modules\User\Http\Controllers\UserController;

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
        'prefix' => 'dashboard/user',
        'as' => 'user.'
    ],
    function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('index');

        Route::post('/datatable', [UserController::class, 'dataTable'])
            ->name('datatable');

        Route::get('/{id}/ver', [
            UserController::class, 'show'
        ])
            ->name('show');

        Route::get('/{id}/editar', [UserController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}/editar', [
            UserController::class, 'update'
        ])
            ->name('update');

        Route::get('/{id}/confirmar-exclusao', [UserController::class, 'confirmDelete'])
            ->name('confirm_delete');

        Route::delete('/{id}/excluir', [UserController::class, 'delete'])
            ->name('delete');
    }
);
