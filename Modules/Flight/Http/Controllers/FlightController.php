<?php

namespace Modules\Flight\Http\Controllers;

use Modules\Flight\Http\Requests;
use Modules\Plane\Entities\Plane;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;
use Modules\Flight\Services\FlightService;

class FlightController extends Controller
{
	protected $flight;

	protected $flight_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Flight\Entities\Flight $flight
	 * @param \Modules\Flight\Services\FlightService $flight_service
	 * @return void
	 */
	public function __construct(
		Flight $flight,
		FlightService $flight_service
	) {
		$this->flight = $flight;
		$this->flight_service = $flight_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('flight::index');
	}

	/**
	 * Obtêm os dados para a tabela
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string
	 */
	public function dataTable()
	{
		$flights = $this->flight->with(['plane', 'origin', 'destination']);

		return dataTables($flights)
			->editColumn("date", function ($flight) {
				return $flight->formatted_date;
			})
			->editColumn("time_duration", function ($flight) {
				return $flight->formatted_time_duration;
			})
			->editColumn("price", function ($flight) {
				return 'R$ ' . $flight->formatted_price;
			})
			->filterColumn(
				'price',
				function ($q, $keyword) {
					$formatted_price = str_replace(',', '.', str_replace('.', '', $keyword));

					$q->where('price', 'LIKE', '%' . $formatted_price . '%');
				}
			)
			->addColumn("plane", function ($flight) {
				return $flight->plane->bland->name;
			})
			->addColumn("origin", function ($flight) {
				return $flight->origin->name;
			})
			->addColumn("destination", function ($flight) {
				return $flight->destination->name;
			})
			->addColumn('action', function ($flight) {
				return view('flight::partials.action', [
					'flight' => $flight
				])
					->render();
			})
			->rawColumns([
				'action'
			])
			->make(true);
	}

	/**
	 * Exibe a tela de cadastro
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$planes = Plane::all();

		$airports = Airport::orderBy('name', 'Asc')->get();

		return view('flight::create', compact('planes', 'airports'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param \Requests\FlightRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Requests\FlightRequest $request)
	{
		$this->flight_service->updateOrCreate($request->all());

		return redirect()
			->route('flight.index')
			->with('message', 'Cadastro realizado com sucesso.');
	}

	/**
	 * Exibe os dados
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		$flight = $this->flight->with(['plane', 'origin', 'destination'])->findOrFail($id);

		return view('flight::show', compact('flight'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$flight = $this->flight->with(['plane', 'origin'])->findOrFail($id);

		$planes = Plane::where('id', '!=', $flight->plane->id ?? '')->get();

		$origins = Airport::orderBy('name', 'ASC')
			->where('id', '!=', $flight->origin->id ?? '')
			->get();

		$destinations = Airport::orderBy('name', 'ASC')
			->where('id', '!=', $flight->destination->id ?? '')
			->get();

		return view('flight::edit', compact(
            'flight',
            'planes',
            'origins',
            'destinations'
        ));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param \Requests\FlightRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Requests\FlightRequest $request, $id)
	{
		$flight = $this->flight->findOrFail($id);

		$this->flight_service->updateOrCreate($request->all(), $flight->id);

		return redirect()
			->route('flight.edit', $flight->id)
			->with('message', 'Atualização realizada com sucesso.');
	}

	/**
	 * Exibe a tela para exclusão
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function confirmDelete($id)
	{
		$flight = $this->flight->with(['plane', 'origin', 'destination'])->findOrFail($id);

		return view('flight::confirm-delete', compact('flight'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$flight = $this->flight->findOrFail($id);

		$this->flight_service->removeData($flight);

		return redirect()
			->route('flight.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
