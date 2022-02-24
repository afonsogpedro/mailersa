<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use File;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        $json = File::get(public_path("data/countries-data.json"));
        $countries = json_decode($json);

        foreach ($countries as $key => $value) {
            Country::create([
                'id' => $value->id,
                'name' => $value->name,
                'iso3' => $value->iso3,
                'numeric_code' => $value->numeric_code,
                'iso2' => $value->iso2,
                'phonecode' => $value->phone_code,
                'capital' => $value->capital,
                'currency' => $value->currency,
                'currency_name' => $value->currency_name,
                'currency_symbol' => $value->currency_symbol,
                'tld' => $value->tld,
                'native' => $value->native,
                'region' => $value->region,
                'subregion' => $value->subregion,
                'timezones' => serialize($value->timezones),
                'translations' => serialize($value->translations),
                'latitude' => $value->latitude,
                'longitude' => $value->longitude,
                'emoji' => $value->emoji,
                'emojiU' => $value->emojiU
            ]);
        }
    }
}
