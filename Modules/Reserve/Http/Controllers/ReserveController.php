<?php

namespace Modules\Reserve\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Flight\Entities\Flight;
use Modules\Reserve\Entities\Reserve;
use Modules\Reserve\Services\ReserveService;
use Modules\Reserve\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{
	protected $reserve;

	protected $reserve_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Reserve\Entities\Reserve $reserve
	 * @param \Modules\Reserve\Services\ReserveService $reserve_service
	 * @return void
	 */
	public function __construct(
		Reserve $reserve,
		ReserveService $reserve_service
	) {
		$this->reserve = $reserve;
		$this->reserve_service = $reserve_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('reserve::index');
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
		$reserves = $this->reserve->with(['user', 'flight']);

		return DataTables::of($reserves)
			->editColumn("date_reserved", function ($reserve) {
				return $reserve->formatted_date_reserved;
			})
			->editColumn("status", function ($reserve) {
				return $reserve->formatted_status;
			})
			->editColumn("user", function ($reserve) {
				return $reserve->user->name;
			})
			->editColumn("flight", function ($reserve) {
				return $reserve->flight->formatted_date;
			})
			->addColumn('action', function ($reserve) {
				return view('reserve::partials.action', [
					'reserve' => $reserve
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
		$users = User::orderBy('name', 'Asc')->get();

		$flights = Flight::all();

		return view('reserve::create', compact('users', 'flights'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  \Modules\Reserve\Http\Requests\ReserveRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ReserveRequest $request)
	{
		$this->reserve_service->updateOrCreate($request->all());

		return redirect()
			->route('reserve.index')
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
		$reserve = $this->reserve->with(['user', 'flight'])->findOrFail($id);

		return view('reserve::show', compact('reserve'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$reserve = $this->reserve->with(['user', 'flight'])->findOrFail($id);

		$users = User::orderBy('name', 'ASC')
			->where('id', '!=', $reserve->user->id ?? '')
			->get();

		$flights = Flight::where('id', '!=', $reserve->flight->id ?? '')->get();

		return view('reserve::edit', compact('reserve', 'users', 'flights'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  \Modules\Reserve\Http\Requests\ReserveRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ReserveRequest $request, $id)
	{
		$reserve = $this->reserve->findOrFail($id);

		$this->reserve_service->updateOrCreate($request->all(), $reserve->id);

		return redirect()
			->route('reserve.edit', $reserve->id)
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
		$reserve = $this->reserve->with(['user', 'flight'])->findOrFail($id);

		return view('reserve::confirm-delete', compact('reserve'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$reserve = $this->reserve->findOrFail($id);

		$this->reserve_service->removeData($reserve);

		return redirect()
			->route('reserve.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
