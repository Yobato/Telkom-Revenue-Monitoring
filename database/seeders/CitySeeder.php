<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'nama_city' => 'Semarang'
            ],
            [
                'nama_city' => 'Pekalongan'
            ]
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
