<?php

namespace Modules\Plane\Services;

use DB;
use Modules\Bland\Entities\Bland;
use Modules\Plane\Entities\Plane;

class PlaneService
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
	 * @return \Modules\Plane\Entities\Plane $plane
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			$plane = Plane::updateOrCreate([
				'id' => $id
			], $request);

			(new Bland)->updateOrCreate(['id' => $plane->bland->id ?? null]);

			DB::commit();

			return $plane;
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Plane\Entities\Plane $plane
	 *
	 * @return void
	 */
	public function removeData($plane)
	{
		DB::beginTransaction();

		try {
			$plane->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
