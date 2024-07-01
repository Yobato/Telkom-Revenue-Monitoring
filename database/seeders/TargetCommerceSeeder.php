<?php

namespace Database\Seeders;

use App\Models\TargetCommerce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetCommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $targetcc = [
            [
                'jenis_laporan' => 'COGS',
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000000, 
                'id_portofolio' => 11
            ],
            [
                'jenis_laporan' => 'REVENUE',
                'bulan' => 'Agustus',
                'tahun' => '2023',
                'jumlah' => 10000000,
                'id_portofolio' => 12
            ]
        ];

        foreach ($targetcc as $targetc) {
            TargetCommerce::create($targetc);
        }
    }
}