<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date("Y-m-d H:i:s");
        $permissions = [
            ['id' => 1, 'name'=> 'crear usuario'      ,'module_id'=> 1 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>2, 'name'=>'listar usuario'        ,'module_id'=> 1 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>3, 'name'=>'actualizar usuario'    ,'module_id'=> 1 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>4, 'name'=>'crear categoria'       ,'module_id'=> 2 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>5, 'name'=>'eliminar usuario'      ,'module_id'=> 1 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>6, 'name'=>'listar categoria'      ,'module_id'=> 2 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>7, 'name'=>'actualizar categoria'  ,'module_id'=> 2 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>8,'name'=> 'eliminar categoria'    ,'module_id'=> 2 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>9,'name'=> 'listar producto'       ,'module_id'=> 3 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>10,'name'=> 'crear producto'       ,'module_id'=> 3 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>11,'name'=> 'actualizar producto'  ,'module_id'=> 3 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>12,'name'=> 'eliminar producto'    ,'module_id'=> 3 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>13,'name'=> 'crear modulo'         ,'module_id'=> 4 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>14,'name'=> 'listar modulo'        ,'module_id'=> 4 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>15,'name'=> 'actualizar modulo'    ,'module_id'=> 4 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>16,'name'=> 'eliminar modulo'      ,'module_id'=> 4 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>17,'name'=> 'insertar imagen de categoria','module_id'=> 2 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>18,'name'=> 'listar permiso'       ,'module_id'=> 5 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>19,'name'=> 'crear permiso'        ,'module_id'=> 5 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>20,'name'=> 'actualizar permiso'   ,'module_id'=> 5 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>21,'name'=> 'eliminar permiso'     ,'module_id'=> 5 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>22,'name'=> 'listar acceso'        ,'module_id'=> 6 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>23,'name'=> 'actualizar acceso'    ,'module_id'=> 6 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>24,'name'=> 'listar rol'           ,'module_id'=> 7 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>25,'name'=> 'crear rol'            ,'module_id'=> 7 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>26,'name'=> 'actualizar rol'       ,'module_id'=> 7 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>27,'name'=> 'eliminar rol'         ,'module_id'=> 7 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>28,'name'=> 'listar cantidad de permiso','module_id'=> 5,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>29,'name'=> 'listar pedido'        ,'module_id'=> 8 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>30,'name'=> 'listar pedido cliente','module_id'=> 9 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>31,'name'=> 'anular pedido cliente','module_id'=> 9 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>32,'name'=> 'anular pedido admin'  ,'module_id'=> 8,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>33,'name'=> 'eliminar pedido'      ,'module_id'=> 8 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>34,'name'=> 'actualizar producto por cancelacion cliente','module_id'=> 9 ,'created_at' => $date,'updated_at'=> $date ],
            ['id'=>35,'name'=> 'ver detalle pedido','module_id'=> 8 ,'created_at' => $date,'updated_at'=> $date ],
        ];
        DB::table('permissions')->insert($permissions);
    }
}
