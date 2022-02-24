<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use File;

class StatesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        State::truncate();

        $json = File::get(public_path("data/states-data.json"));
        $states = json_decode($json);

        foreach ($states as $key => $value) {
            State::create([
                "id" => $value->id,
                "name" => $value->name,
                "country_id" => $value->country_id,
                "country_code" => $value->country_code,
                "country_name" => $value->country_name,
                "state_code" => $value->state_code,
                "type" => $value->type,
                "latitude" => $value->latitude,
                "longitude" => $value->longitude,
            ]);
        }
    }
}
