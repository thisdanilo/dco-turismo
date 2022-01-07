<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Modules\User\Http\Requests;
use Illuminate\Routing\Controller;
use Modules\User\Services\UserService;

class UserController extends Controller
{
	protected $user;

	protected $user_service;

	/**
	 * Método Construtor
	 *
	 * @param \App\Models\User $user
	 * @param \Modules\User\Services\UserService $user_service
	 * @return void
	 */
	public function __construct(
		User $user,
		UserService $user_service
	) {
		$this->user = $user;
		$this->user_service = $user_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('user::index');
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
		$users = $this->user->query();

		return dataTables($users)
			->addColumn('action', function ($user) {
				return view('user::partials.action', [
					'user' => $user
				])
					->render();
			})
			->rawColumns([
				'action'
			])
			->make(true);
	}

	/**
	 * Exibe os dados
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);

		return view('user::show', compact('user'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$user = $this->user->findOrFail($id);

		return view('user::edit', compact('user'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param \Requests\UserRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Requests\UserRequest $request, $id)
	{
		$user = $this->user->findOrFail($id);

		$this->user_service->update($request->all(), $user->id);

		return redirect()
			->route('user.edit', $user->id)
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
		$user = $this->user->findOrFail($id);

		return view('user::confirm-delete', compact('user'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$user = $this->user->findOrFail($id);

		$this->user_service->removeData($user);

		return redirect()
			->route('user.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
