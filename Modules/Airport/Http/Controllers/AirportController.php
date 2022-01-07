<?php

namespace Modules\Airport\Http\Controllers;

use Modules\City\Entities\City;
use Modules\Bland\Entities\Bland;
use Illuminate\Routing\Controller;
use Modules\Airport\Http\Requests;
use Modules\Airport\Entities\Airport;
use Modules\Airport\Services\AirportService;

class AirportController extends Controller
{
	protected $airport;

	protected $airport_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Airport\Entities\Airport $airport
	 * @param \Modules\Airport\Services\AirportService $airport_service
	 * @return void
	 */
	public function __construct(
		Airport $airport,
		AirportService $airport_service
	) {
		$this->airport = $airport;
		$this->airport_service = $airport_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('airport::index');
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
		$airports = $this->airport->with('city');

		return datatables($airports)
			->editColumn("class", function ($airport) {
				return $airport->formatted_class;
			})
			->editColumn("city", function ($airport) {
				return $airport->city->name;
			})
			->addColumn('action', function ($airport) {
				return view('airport::partials.action', [
					'airport' => $airport
				])
					->render();
			})
			->rawColumns([
				'action'
			])
			->make();
	}

	/**
	 * Exibe a tela de cadastro
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$cities = City::orderBy('name', 'Asc')->get();

		return view('airport::create', compact('cities'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  Requests\AirportRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Requests\AirportRequest $request)
	{
		$this->airport_service->updateOrCreate($request->all());

		return redirect()
			->route('airport.index')
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
		$airport = $this->airport->with('city')->findOrFail($id);

		return view('airport::show', compact('airport'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$airport = $this->airport->with('city')->findOrFail($id);

		$cities = Bland::orderBy('name', 'ASC')
			->where('id', '!=', $airport->city->id ?? '')
			->get();

		return view('airport::edit', compact('airport', 'cities'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  Requests\AirportRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Requests\AirportRequest $request, $id)
	{
		$airport = $this->airport->findOrFail($id);

		$this->airport_service->updateOrCreate($request->all(), $airport->id);

		return redirect()
			->route('airport.edit', $airport->id)
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
		$airport = $this->airport->with('city')->findOrFail($id);

		return view('airport::confirm-delete', compact('airport'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$airport = $this->airport->findOrFail($id);

		$this->airport_service->removeData($airport);

		return redirect()
			->route('airport.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
