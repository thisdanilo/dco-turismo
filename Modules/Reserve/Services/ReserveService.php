<?php

namespace Modules\Reserve\Services;

use DB;
use Modules\Reserve\Entities\Reserve;

class ReserveService
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
            Reserve::updateOrCreate([
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
     * @param \Modules\Reserve\Entities\Reserve $reserve
     *
     * @return void
     */
    public function removeData($reserve)
    {
        DB::beginTransaction();

        try {
            $reserve->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }
}
