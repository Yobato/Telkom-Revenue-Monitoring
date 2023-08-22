<?php

namespace Database\Seeders;

use App\Models\SubGrupAkun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubGrupAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subGrupAkun = [
            [
                'nama_sub' => 'Material Non Stock'
            ],
            [
                'nama_sub' => 'Material Stock'
            ],
            [
                'nama_sub' => 'Jasa'
            ],
            [
                'nama_sub' => 'Depresiasi'
            ],
            [
                'nama_sub' => 'MS CAPEX'
            ],
            [
                'nama_sub' => 'Naker'
            ],
            [
                'nama_sub' => 'Operasional'
            ],
            [
                'nama_sub' => 'Sewa'
            ],
        ];

        foreach ($subGrupAkun as $akun) {
            SubGrupAkun::create($akun);
        }
    }
}
