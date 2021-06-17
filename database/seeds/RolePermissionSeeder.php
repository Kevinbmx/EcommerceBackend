<?php

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
        $permissions = [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10],
            [11],
            [12],
            [13],
            [14],
            [15],
            [16],
            [17],
            [18],
            [19],
            [20],
            [21],
            [22],
            [23],
            [24],
            [25],
            [26],
            [27],
            [28],
            [29],
            [32],
            [33],
        ];
        $rolePermission = App\Models\Role::find(1);
        foreach ($permissions as $permission) {
            $rolePermission->permissions()->attach($permission);
        }
        $permissions = [
            [30],
            [31],
            [34],
        ];
        $rolePermission = App\Models\Role::find(2);
        foreach ($permissions as $permission) {
            $rolePermission->permissions()->attach($permission);
        }
    }
}
