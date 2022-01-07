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
			'date' => 'required', 'date',
			'time_duration' => 'required', 'time',
			'hour_output' => 'required', 'time',
			'arrival_time' => 'required', 'time',
			'old_price' => 'required', 'decimal',
			'price' => 'required', 'decimal',
			'total_prots' => 'required', 'integer',
			'is_promotion' => 'required', 'boolean',
			'qty_stops' => 'required', 'integer',
			'description' => 'nullable', 'text'
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
