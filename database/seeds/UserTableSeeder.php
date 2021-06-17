<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    factory(App\Models\User::class,20)->create();
        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'role_id'=>'1',
            'password'=> bcrypt('secret')
        ]);
        User::create([
            'name'=>'kevin delgadillo',
            'email'=>'kevi3195@gmail.com',
            'role_id'=>'2',
            'password'=> bcrypt('secret')
        ]);
    //    Role::create([
    //         'name' => 'Admin',
    //         'slug' => 'admin',
    //         'special'=> 'all-access'
    //    ]);
//        App\Models\Role_User::create([
//         'role_id' => '1',
//         'user_id' => '1',
//    ]);
    }
}
