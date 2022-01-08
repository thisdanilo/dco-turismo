<?php

namespace Modules\Dashboard\Http\Controllers;

use Modules\User\Entities\User;
use Modules\Plane\Entities\Plane;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;
use Modules\Reserve\Entities\Reserve;

class DashboardController extends Controller
{
	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$users = User::count();

		$planes = Plane::count();

		$airports = Airport::count();

		$flights = Flight::count();

		$reserves = Reserve::count();

		return view('dashboard::index', compact('users', 'planes', 'airports', 'flights', 'reserves'));
	}
}
