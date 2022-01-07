<?php

use Modules\Plane\Http\Controllers\PlaneController;

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
		'prefix' => 'dashboard/plane',
		'as' => 'plane.'
	],
	function () {

		Route::get('/', [PlaneController::class, 'index'])
			->name('index');

		Route::post('/datatable', [PlaneController::class, 'dataTable'])
			->name('datatable');

		Route::get('/{id}/ver', [PlaneController::class, 'show'])
			->name('show');

		Route::get('/cadastrar', [PlaneController::class, 'create'])
			->name('create');

		Route::post('/cadastrar', [PlaneController::class, 'store'])
			->name('store');

		Route::get('/{id}/editar', [PlaneController::class, 'edit'])
			->name('edit');

		Route::put('/{id}/editar', [PlaneController::class, 'update'])
			->name('update');

		Route::get('/{id}/confirmar-exclusao', [PlaneController::class, 'confirmDelete'])
			->name('confirm_delete');

		Route::delete('/{id}/excluir', [PlaneController::class, 'delete'])
			->name('delete');
	}
);
