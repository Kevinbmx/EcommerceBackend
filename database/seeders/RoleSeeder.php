<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date("Y-m-d H:i:s");
        $rols = [
            ['id' => 1, 'name'=> 'admin','description'=> 'administra todo el sistema completo','created_at' => $date,'updated_at'=> $date ],
            ['id' => 2, 'name'=>'cliente','description'=> 'agregar items a carrito y hace pedidos','created_at' => $date,'updated_at'=> $date ],
            ['id' => 3, 'name'=>'visitor','description'=> 'solo puede ver todo la administracion','created_at' => $date,'updated_at'=> $date]
        ];
        DB::table('roles')->insert($rols);
    }
}
