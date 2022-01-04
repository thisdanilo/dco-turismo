<?php

namespace Modules\Reserve\Rules;

use Modules\Flight\Entities\Flight;
use Illuminate\Contracts\Validation\Rule;

class CheckAvailableFlight implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $flight =  Flight::with(['plane', 'reserves'])->find($value);

        $plane = $flight->plane;

        $qty_passengers = $plane->total_passengers;

        $qty_reserves = $flight->reserves->count();

        return $qty_passengers > $qty_reserves;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A quantidade de reservas superou a quantidade de passageiros permitidos!.';
    }
}
