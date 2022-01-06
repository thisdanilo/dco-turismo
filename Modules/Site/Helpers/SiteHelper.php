<?php

namespace Modules\Site\Helpers;

use Carbon\Carbon;

class SiteHelper
{
    /**
     * Formata a data
     *
     * @param string $value
     * @param string $format
     * @return string
     */
    public static function formatDateAndTime($value, $format = 'd/m/Y')
    {
        return Carbon::parse($value)->format($format);
    }

    /**
     * Filtra por aeroporto
     *
     * @param string $city
     * @return array
     */
    public static function getInfoAirport($city)
    {
        $data_city = explode(' - ', $city);

        $id_airport = $data_city[0];

        $data_city = explode(' / ', $data_city[1]);

        $city_name = $data_city[0];

        $airport_name = $data_city[1];

        return [
            'id_airport' => $id_airport,
            'name_airport' => $airport_name,
            'name_city' => $city_name
        ];

    }
}
