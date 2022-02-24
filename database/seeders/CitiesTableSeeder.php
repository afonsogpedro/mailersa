<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use File;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * the cities is large, we need to break it in parts
     * @return void
     */
    public function run()
    {
        City::truncate();

        $json = File::get(public_path("data/cities-data.json"));
        $cities = json_decode($json);

        foreach ($cities as $key => $value) {
            City::create([
                "id" => $value->id,
                "name" => $value->name,
                "state_id" => $value->state_id,
                "state_code" => $value->state_code,
                "state_name" => $value->state_name,
                "country_id" => $value->country_id,
                "country_code" => $value->country_code,
                "country_name" => $value->country_name,
                "latitude" => $value->latitude,
                "longitude" => $value->longitude,
                "wikiDataId" => $value->wikiDataId,
            ]);
        }
    }
}
