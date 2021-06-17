<?php

use Illuminate\Database\Seeder;
use App\Models\StatusProduct;

class statusProductTableSeeder extends Seeder
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
