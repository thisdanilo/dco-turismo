<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Modules\Site\Helpers\SiteHelper;
use Modules\Airport\Entities\Airport;
use Hexadog\ThemesManager\Facades\ThemesManager;

class SiteController extends Controller
{
    public function __construct()
    {
        $theme = Config('themes-manager.theme_active');

        ThemesManager::set($theme);
    }

    /* Tela home */
    public function home()
    {
        $airports = Airport::with('city')->get();

        return view('pages.home', compact('airports'));
    }

    /* Tela de promoções */
    public function promotions()
    {
        return view('pages.promotions');
    }

    /* Pesquisa por cidades */
    public function searchFlights(Request $request, Flight $flight)
    {
        $origin = SiteHelper::getInfoAirport($request->origin);

        $destination = SiteHelper::getInfoAirport($request->destination);

        $flights = $flight->searchFlights($origin['id_airport'], $destination['id_airport'], $request->date);

        return view('pages.search', [
            'origin' => $origin['name_city'],
            'destination' => $destination['name_city'],
            'date' => SiteHelper::formatDateAndTime($request->date),
            'flights' => $flights
        ]);
    }
}
