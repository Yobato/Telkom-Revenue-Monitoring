<?php

namespace Database\Seeders;

use App\Models\Peruntukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeruntukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peruntukan = [
            [
                'nama_peruntukan' => 'ATK'
            ],
            [
                'nama_peruntukan' => 'Konsumsi'
            ],
            [
                'nama_peruntukan' => 'dst'
            ],
        ];

        foreach ($peruntukan as $prtk) {
            Peruntukan::create($prtk);
        }
    }
}
