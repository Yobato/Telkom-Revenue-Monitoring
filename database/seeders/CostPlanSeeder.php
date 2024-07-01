<?php

namespace Database\Seeders;

use App\Models\CostPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costplan = [
            [
                'nama_cost_plan' => 'Operasional'
            ],
            [
                'nama_cost_plan' => 'MATERIAl NON STOK'
            ],
            [
                'nama_cost_plan' => 'Sewa'
            ],
        ];

        foreach ($costplan as $cost) {
            CostPlan::create($cost);
        }
    }
}
