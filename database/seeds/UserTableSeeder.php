<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
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
        App\Model\User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=> bcrypt('secret')
        ]);
    //    Role::create([
    //         'name' => 'Admin',
    //         'slug' => 'admin',
    //         'special'=> 'all-access'
    //    ]);
//        App\Model\Role_User::create([
//         'role_id' => '1',
//         'user_id' => '1',
//    ]);
    }
}
