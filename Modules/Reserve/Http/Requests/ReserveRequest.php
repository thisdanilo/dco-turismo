<?php

namespace Modules\Reserve\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Reserve\Rules\CheckAvailableFlight;

class ReserveRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'flight_id' => [
                'required',
                new CheckAvailableFlight
            ],
            'user_id' => 'required',
            'date_reserved' => 'required', 'date',
            'status' => 'required', 'enum'
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
