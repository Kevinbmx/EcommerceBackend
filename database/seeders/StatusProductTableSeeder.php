<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Seeder;

class StatusProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusProduct::create([
            'statusName'=>'Nuevo',
        ]);
        StatusProduct::create([
            'statusName'=>'2da Mano - Casi Nuevo',
        ]);
        StatusProduct::create([
            'statusName'=>'2da Mano - Muy Bueno',
        ]);
        StatusProduct::create([
            'statusName'=>'2da Mano - Bueno',
        ]);
        StatusProduct::create([
            'statusName'=>'bien',
        ]);
    }
}
