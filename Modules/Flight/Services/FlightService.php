<?php

namespace Modules\Flight\Services;

use DB;
use Modules\Flight\Entities\Flight;

class FlightService
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
	 * Cadastra ou atualiza o registro
	 *
	 * @param array $request
	 * @param int|null $id
	 *
	 * @return void
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			Flight::updateOrCreate([
				'id' => $id
			], $request);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Flight\Entities\Flight $flight
	 *
	 * @return void
	 */
	public function removeData($flight)
	{
		DB::beginTransaction();

		try {
			$flight->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
