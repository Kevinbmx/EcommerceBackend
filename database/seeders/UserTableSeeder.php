<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'role_id'=>'1',
            'password'=> bcrypt('secret')
        ]);
        User::create([
            'name'=>'kevin delgadillo',
            'email'=>'kevi3195@gmail.com',
            'role_id'=>'1',
            'password'=> bcrypt('secret')
        ]);
        User::create([
            'name'=>'anabela salazar jordan',
            'email'=>'anabela.salazar.jordan@gmail.com',
            'role_id'=>'2',
            'password'=> bcrypt('secret')
        ]);
        User::create([
            'name'=>'miguel angel delgadillo',
            'email'=>'miguel.delgadillow5@gmail.com',
            'role_id'=>'4',
            'password'=> bcrypt('secret')
        ]);
    }
}
