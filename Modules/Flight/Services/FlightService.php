<?php

namespace Modules\Flight\Services;

use DB;
use Modules\Airport\Entities\Airport;
use Modules\Flight\Entities\Flight;
use Modules\Plane\Entities\Plane;

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
     * @return \Modules\Flight\Entities\Flight $flight
     */
    public function updateOrCreate($request, $id = null)
    {
        DB::beginTransaction();

        try {

            $data = [
                'plane_id' => $request['plane_id'],
                'airport_origin_id' => $request['airport_origin_id'],
                'airport_destination_id' => $request['airport_destination_id'],
                'date' => $request['date'],
                'time_duration' => $request['time_duration'],
                'hour_output' => $request['hour_output'],
                'arrival_time' => $request['arrival_time'],
                'old_price' => $request['old_price'],
                'price' => $request['price'],
                'total_prots' => $request['total_prots'],
                'is_promotion' => $request['is_promotion'],
                'qty_stops' => $request['qty_stops'],
                'description' => $request['description']
            ];

            $flight = Flight::updateOrCreate([
                'id' => $data
            ], $request);

            DB::commit();

            return $flight;
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
