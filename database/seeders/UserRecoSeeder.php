<?php

namespace Database\Seeders;

use App\Models\UserReco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userreco = [
            [
                'nama_user_reco' => 'SS'
            ],
            [
                'nama_user_reco' => 'PROVISIONING'
            ],
            [
                'nama_user_reco' => 'IOAN'
            ],
            [
                'nama_user_reco' => 'KONSTRUKSI'
            ],
        ];

        foreach ($userreco as $user) {
            UserReco::create($user);
        }
    }
}
