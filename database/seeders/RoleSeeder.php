<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'nama_role' => 'Commerce',
            ],
            [
                'nama_role' => 'Finance',
            ],
            [
                'nama_role' => 'Admin',
            ],
            [
                'nama_role' => 'GM',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
