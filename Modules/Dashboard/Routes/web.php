<?php

use Modules\Dashboard\Http\Controllers\DashboardController;

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
		'prefix' => 'dashboard',
		'as' => 'dashboard.'
	],
	function () {
		Route::get('/', [DashboardController::class, 'index'])
			->name('index');
	}
);
