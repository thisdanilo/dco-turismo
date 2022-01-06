<?php

namespace Modules\Site\Services;

use DB;

class SiteService
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
    public function update($request)
    {
        DB::beginTransaction();

        try {

            $user = auth()->user();

            $user->name = $request['name'];

            if ($request['password'])
                $user->password = bcrypt($request['password']);

            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }

    /**
     * Exclui e retorna a tela inicial
     *
     * @param \Modules\User\Entities\User $user
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
