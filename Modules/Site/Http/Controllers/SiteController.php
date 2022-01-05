<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Modules\Site\Helpers\SiteHelper;
use Modules\Airport\Entities\Airport;
use Modules\Reserve\Entities\Reserve;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Support\Facades\Auth;
use Modules\Reserve\Http\Requests\ReserveRequest;

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
    public function promotions(Flight $flight)
    {
        $promotions = $flight->promotions();

        return view('pages.promotions', compact('promotions'));
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

    /* Tela detalhes do voo */
    public function flightDetails($id)
    {
        $flight = Flight::with(['origin', 'destination'])->findOrFail($id);

        return view('pages.flight-details', compact('flight'));
    }

    /* Tela reserva */
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

    /* Tela de compras */
    public function purchases()
    {
        $purchases = auth()
            ->user()
            ->reserves()
            ->orderBy('date_reserved', 'desc')
            ->get();

        return view('pages.purchases', compact('purchases'));
    }

    /* Tela detalhes da compra */
    public function purchaseDetails($id)
    {
        $reserve = Reserve::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->get()
            ->first();

        $purchase = Flight::with(['origin', 'destination'])->find($reserve->flight_id);

        return view('pages.purchase-details', compact('purchase'));
    }

    /* Tela do perfil */
    public function myProfile()
    {
        return view('pages.my-profile');
    }

    /* Atualizar perfil */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->name = $request->name;

        if ($request->password)
            $user->password = bcrypt($request->password);

        $user->save();

        return redirect()
            ->route('my.profile')
            ->with('message', 'Atualização realizada com sucesso.');
    }

    /* Sair da sessão */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
