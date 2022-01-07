<?php

namespace Modules\User\Services;

use DB;
use App\Models\User;

class UserService
{
	/*--------------------------------------------------------------------------
	| Main Function
	|--------------------------------------------------------------------------
	|
	| Métodos principais do CRUD.
	| Define os métodos e as regras de negócio relacionadas ao CRUD.
	|
	*/

	/**
	 * Atualiza o registro
	 *
	 * @param array $request
	 * @param int|null $id
	 *
	 * @return void
	 */
	public function update($request, $id = null)
	{
		DB::beginTransaction();

		try {
			$data = [
				'name' => $request['name'],
				'email' => $request['email']
			];

			if (isset($request['password'])) {
				$data += ['password' => bcrypt($request['password'])];
			}

			User::updateOrCreate([
				'id' => $id
			], $data);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \App\Models\User $user
	 *
	 * @return void
	 */
	public function removeData($user)
	{
		DB::beginTransaction();

		try {
			$user->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
