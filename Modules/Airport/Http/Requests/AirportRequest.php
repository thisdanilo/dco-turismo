<?php

namespace Modules\Airport\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'city_id' => 'required',
			'name' => 'required', 'string',
			'latitude' => 'required', 'string',
			'longitude' => 'required', 'string',
			'address' => 'required', 'string',
			'number' => 'required', 'string',
			'zip_code' => 'required', 'string'
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
