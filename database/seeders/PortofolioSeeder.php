<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portofolio = [
            [
                'nama_portofolio' => 'Construction',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'Dismanting',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'Migrasi',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'MS Capex Telkom',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'MS Opex Telkom',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'NTE',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'Provisioning',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'SDI',
                'role' => 'Finance'
            ],
        ];

        foreach ($portofolio as $porto) {
            Portofolio::create($porto);
        }
    }
}
