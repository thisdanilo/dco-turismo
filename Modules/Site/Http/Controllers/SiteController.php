<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Illuminate\Support\Facades\Auth;
use Modules\Site\Helpers\SiteHelper;
use Modules\Airport\Entities\Airport;
use Modules\Reserve\Entities\Reserve;
use Modules\Site\Services\SiteService;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Modules\Reserve\Http\Requests\ReserveRequest;

class SiteController extends Controller
{
    public function __construct()
    {
        $theme = Config('themes-manager.theme_active');

        ThemesManager::set($theme);
    }

    /**
     * Tela home
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $airports = Airport::with('city')->get();

        return view('pages.home', compact('airports'));
    }

    /**
     * Tela de promoções
     *
     * @param Flight $flight
     * @return \Illuminate\View\View
     */
    public function promotions(Flight $flight)
    {
        $promotions = $flight->promotions();

        return view('pages.promotions', compact('promotions'));
    }

    /**
     * Pesquisa por cidades
     *
     * @param Request $request
     * @param Flight $flight
     * @return array
     */
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

    /**
     * Exibe os dados
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function flightDetails($id)
    {
        $flight = Flight::with(['origin', 'destination'])->findOrFail($id);

        return view('pages.flight-details', compact('flight'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param  \Modules\Reserve\Http\Requests\ReserveRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reserveFlight(ReserveRequest $request, Reserve $reserve)
    {
        if ($reserve->newReserve($request->flight_id))
            return redirect()
                ->route('purchases')
                ->with('message', 'Reserva realizada com sucesso.');

        return redirect()
            ->route('flight.details')
            ->with('alert', 'Falha ao reservar.');
    }

    /**
     * Exibe os dados
     *
     * @return \Illuminate\View\View
     */
    public function purchases()
    {
        $purchases = auth()
            ->user()
            ->reserves()
            ->orderBy('date_reserved', 'desc')
            ->get();

        return view('pages.purchases', compact('purchases'));
    }

    /**
     * Exibe os dados
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function purchaseDetails($id)
    {
        $reserve = Reserve::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->get()
            ->first();

        $purchase = Flight::with(['origin', 'destination'])->find($reserve->flight_id);

        return view('pages.purchase-details', compact('purchase'));
    }

    /**
     * Exibe a tela do perfil.
     *
     * @return \Illuminate\View\View
     */
    public function myProfile()
    {
        return view('pages.my-profile');
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param  \Modules\Reserve\Http\Requests\ReserveRequest $request
     * @param  \Modules\Site\Services\SiteService $site_service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, SiteService $site_service)
    {
        $site_service->update($request->all());

        return redirect()
            ->route('my.profile')
            ->with('message', 'Atualização realizada com sucesso.');
    }

    /**
     * Sai da sessão
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
