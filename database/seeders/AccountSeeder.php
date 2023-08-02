<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Bagas',
                'nik' => '123456789',
                'password' => bcrypt('12345678'), 
                'role' => "Commerce",
                'keterangan' => "",
                "kota"=> 1
            ],
            [
                'nama' => 'Raha',
                'nik' => '234567891',
                'password' => bcrypt('12345678'), 
                'role' => "Finance",
                'keterangan' => "",
                "kota"=> 1
            ],
            [
                'nama' => 'Dhito',
                'nik' => '345678912',
                'password' => bcrypt('12345678'), 
                'role' => "Admin",
                'keterangan' => "",
                "kota"=> 1
            ],
            [
                'nama' => 'Robith',
                'nik' => '456789123',
                'password' => bcrypt('12345678'), 
                'role' => "GM",
                'keterangan' => "",
                "kota"=> 1
            ],
            [
                'nama' => 'Willy',
                'nik' => '567891234',
                'password' => bcrypt('12345678'), 
                'role' => "Commerce",
                'keterangan' => "",
                "kota"=> 2
            ],
            [
                'nama' => 'Admin',
                'nik' => 'Admin',
                'password' => bcrypt('12345678'), 
                'role' => "Admin",
                'keterangan' => "",
                "kota"=> 2
            ]
        ];

        foreach ($users as $user) {
            Account::create($user);
        }
    }
}
