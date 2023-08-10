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
            
        ];

        foreach ($program as $prog) {
            Program::create($prog);
        }
    }
}
