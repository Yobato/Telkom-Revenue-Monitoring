<?php

namespace Database\Seeders;

use App\Models\TargetFinance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetFinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $targetff = [
            [
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000000, 
                'id_portofolio' => 7
            ],
            [
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000000,
                'id_portofolio' => 2
            ]
        ];

        foreach ($targetff as $targetf) {
            TargetFinance::create($targetf);
        }
    }
}