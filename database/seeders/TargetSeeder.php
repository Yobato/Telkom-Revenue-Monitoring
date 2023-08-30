<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
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
                'jenis_laporan' => 'COGS',
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000
            ],
            [
                'jenis_laporan' => 'KKP',
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000
            ],
            [
                'jenis_laporan' => 'REVENUE',
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000
            ],
            [
                'jenis_laporan' => 'COGS',
                'bulan' => 'Juli',
                'tahun' => '2023',
                'jumlah' => 10000
            ]
        ];

        foreach ($cities as $city) {
            Target::create($city);
        }
    }
}
