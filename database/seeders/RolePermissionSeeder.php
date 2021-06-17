<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
            31,
            32,
            33,
            34,
            35,
        );
        $rolePermission = Role::find(1);
        $rolePermission->permissions()->attach($permissions);
        $rolePermission = Role::find(4);
        $rolePermission->permissions()->attach($permissions);

        $permissions = array(
            30,
            31,
            34,
        );
        $rolePermission = Role::find(2);
        $rolePermission->permissions()->attach($permissions);
    }
}
