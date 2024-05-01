<?php

namespace Database\Seeders;

use App\Models\Pph;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pph =[
            [
                'nama_pph' => 'PPN - 0% V7',
                'nilai_pph' => 0
            ],
            [
                'nama_pph' => 'PPN - 0% V8',
                'nilai_pph' => 0
            ],
            [
                'nama_pph' => 'PPN - 1%',
                'nilai_pph' => 1
            ],
            [
                'nama_pph' => 'PPN - 1,1%',
                'nilai_pph' => 1.1
            ],
            [
                'nama_pph' => 'PPN - 10%',
                'nilai_pph' => 10
            ],
            [
                'nama_pph' => 'PPN - 11%',
                'nilai_pph' => 11
            ],
            [
                'nama_pph' => 'PPh Ps 21: NPWP - 5%',
                'nilai_pph' => 5
            ],
            [
                'nama_pph' => 'PPh Ps 21: NPWP (Bukan Peg) - 5%',
                'nilai_pph' => 5
            ],
            [
                'nama_pph' => 'PPh Ps 21: Non NPWP (Bukan Peg) - 6%',
                'nilai_pph' => 6
            ],
            [
                'nama_pph' => 'PPh Ps 21: Non NPWP - 6%',
                'nilai_pph' => 6
            ],
            [
                'nama_pph' => 'PPh Ps 23: NPWP - 2%',
                'nilai_pph' => 2
            ],
            [
                'nama_pph' => 'PPh Ps 23: Non NPWP - 4%',
                'nilai_pph' => 4
            ],
            [
                'nama_pph' => 'PPh Ps 23: NPWP - 15%',
                'nilai_pph' => 15
            ],
            [
                'nama_pph' => 'PPh Ps 23: Non NPWP - 30%',
                'nilai_pph' => 30
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 1,75%',
                'nilai_pph' => 1.75
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 2%',
                'nilai_pph' => 2
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 2,65%',
                'nilai_pph' => 2.65
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 3%',
                'nilai_pph' => 3
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 3,5%',
                'nilai_pph' => 3.5
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 4%',
                'nilai_pph' => 4
            ],
            [
                'nama_pph' => 'PPh Ps 4: Konstruksi - 6%',
                'nilai_pph' => 6
            ],
            [
                'nama_pph' => 'PPh Ps 4: Sewa - 10%',
                'nilai_pph' => 10
            ],
        ];
        
        foreach ($pph as $p) {
            Pph::create($p);
        }
    }
}