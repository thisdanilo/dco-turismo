<?php

namespace Modules\Airport\Services;

use DB;
use Modules\Airport\Entities\Airport;
use Modules\City\Entities\City;

class AirportService
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
     * @return \Modules\Airport\Entities\Airport $airport
     */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			$airport = Airport::updateOrCreate([
				'id' => $id
			], $request);

            (new City)->updateOrCreate(['id' => $airport->city->id ?? null]);

			DB::commit();

            return $airport;
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Airport\Entities\Airport $airport
	 *
	 * @return void
	 */
	public function removeData($airport)
	{
		DB::beginTransaction();

		try {
			$airport->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
