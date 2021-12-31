<?php

namespace Modules\City\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\City\Entities\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(__DIR__ . "/data/city.json");

        $cities = json_decode($json, true);

        City::insert($cities);
    }
}
