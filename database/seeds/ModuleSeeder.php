<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date("Y-m-d H:i:s");
        $modules = [
            ['id'=>1,'name'=>'usuario','created_at' => $date,'updated_at'=> $date],
            ['id'=>2,'name'=>'categoria','created_at' => $date,'updated_at'=> $date],
            ['id'=>3,'name'=>'producto','created_at' => $date,'updated_at'=> $date],
            ['id'=>4,'name'=>'modulo','created_at' => $date,'updated_at'=> $date],
            ['id'=>5,'name'=>'permiso','created_at' => $date,'updated_at'=> $date],
            ['id'=>6,'name'=>'acceso','created_at' => $date,'updated_at'=> $date],
            ['id'=>7,'name'=>'rol','created_at' => $date,'updated_at'=> $date],
            ['id'=>8,'name'=>'pedido','created_at' => $date,'updated_at'=> $date]
        ];
        DB::table('modules')->insert($modules);

        // App\Model\Module::create($modules);
    }
}
