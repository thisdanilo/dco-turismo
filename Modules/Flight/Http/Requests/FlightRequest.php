<?php

namespace Modules\Flight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'plane_id' => 'required',
			'airport_origin_id' => 'required',
			'airport_destination_id' => 'required',
			'date' => 'required|date',
			'time_duration' => 'required',
			'hour_output' => 'required',
			'arrival_time' => 'required',
			'old_price' => 'required',
			'price' => 'required',
			'total_prots' => 'required',
			'is_promotion' => 'required',
			'qty_stops' => 'required',
			'description' => 'nullable'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}
