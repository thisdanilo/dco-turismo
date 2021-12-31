<?php

namespace Modules\State\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\State\Entities\State;
use Illuminate\Support\Facades\File;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(__DIR__ . "/data/state.json");

        $states = json_decode($json, true);

        State::insert($states);
    }
}
