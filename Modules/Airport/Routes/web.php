<?php

use Modules\Airport\Http\Controllers\AirportController;

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
		'prefix' => 'dashboard/airport',
		'as' => 'airport.'
	],
	function () {
		Route::get('/', [AirportController::class, 'index'])
			->name('index');

		Route::post('/datatable', [AirportController::class, 'dataTable'])
			->name('datatable');

		Route::get('/{id}/ver', [AirportController::class, 'show'])
			->name('show');

		Route::get('/cadastrar', [AirportController::class, 'create'])
			->name('create');

		Route::post('/cadastrar', [AirportController::class, 'store'])
			->name('store');

		Route::get('/{id}/editar', [AirportController::class, 'edit'])
			->name('edit');

		Route::put('/{id}/editar', [AirportController::class, 'update'])
			->name('update');

		Route::get('/{id}/confirmar-exclusao', [AirportController::class, 'confirmDelete'])
			->name('confirm_delete');

		Route::delete('/{id}/excluir', [AirportController::class, 'delete'])
			->name('delete');
	}
);
