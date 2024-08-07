<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(PortofolioSeeder::class);
        $this->call(PphSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(CostPlanSeeder::class);
        $this->call(PeruntukanSeeder::class);
        $this->call(UserRecoSeeder::class);
        $this->call(SubGrupAkunSeeder::class);
        $this->call(TargetCommerceSeeder::class);
        $this->call(TargetFinanceSeeder::class);


    }
}