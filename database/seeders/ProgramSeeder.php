<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program = [
            [
                'nama_program' => 'OSP',
                'kode_program' => 'OSP-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'OSP Granular',
                'kode_program' => 'OSP Granular-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'HEM',
                'kode_program' => 'HEM-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'NODE B OlO',
                'kode_program' => 'NODE B OlO-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'PT 2',
                'kode_program' => 'PT 2-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'IOAN',
                'kode_program' => 'IOAN-Test',
                'role' => 'Finance'
            ],
            [
                'nama_program' => 'OSP',
                'kode_program' => '3',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'PT2',
                'kode_program' => '4',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'OSP GRANULAR',
                'kode_program' => '5',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'WIFI',
                'kode_program' => '6',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'NODE B',
                'kode_program' => '7',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'HEM',
                'kode_program' => '8',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Project SPBU',
                'kode_program' => '9',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'konstruksi & Partnership',
                'kode_program' => '10',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Scrapped',
                'kode_program' => '23',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'QE Recovery',
                'kode_program' => '14',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'QE Akses',
                'kode_program' => '15',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Relok Alpro',
                'kode_program' => '16',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Relok Utilitas',
                'kode_program' => '17',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Migrasi',
                'kode_program' => '13',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'MS SPBU',
                'kode_program' => '18',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'IOAN',
                'kode_program' => '19',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'TDS',
                'kode_program' => '21',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'MS NTE',
                'kode_program' => '22',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Provisioning',
                'kode_program' => '12',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Survery, Drawing, Inventory',
                'kode_program' => '11',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Smarllworld',
                'kode_program' => '24',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Provisioning EBIS',
                'kode_program' => '26',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'QE Akses Project',
                'kode_program' => '27',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'MS Service Node',
                'kode_program' => '25',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Provisioning WIBS',
                'kode_program' => '28',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'MS Node B',
                'kode_program' => '30',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'Node B OLO',
                'kode_program' => '32',
                'role' => 'Commerce'
            ],
            [
                'nama_program' => 'QE Recovery Q4',
                'kode_program' => '41',
                'role' => 'Commerce'
            ],
            
        ];

        foreach ($program as $prog) {
            Program::create($prog);
        }
    }
}
