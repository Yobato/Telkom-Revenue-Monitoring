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
                'nama_portofolio' => 'CONSTRUCTION',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'MS OPEX',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'Migrasi',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'OPERATION',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'SDI',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'MS NTE',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'FA',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'DISMANTLING',
                'role' => 'Finance'
            ],
            [
                'nama_portofolio' => 'Konstruksi',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'Dismantling',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'MS CAPEX',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'Migrasi',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'MS OPEX',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'SDI',
                'role' => 'Commerce'
            ],
            [
                'nama_portofolio' => 'Provisioning',
                'role' => 'Commerce'
            ]
            
        ];

        foreach ($portofolio as $porto) {
            Portofolio::create($porto);
        }
    }
}