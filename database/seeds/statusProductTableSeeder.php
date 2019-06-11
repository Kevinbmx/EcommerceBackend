<?php

use Illuminate\Database\Seeder;

class statusProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\StatusProduct::create([
            'statusName'=>'Nuevo',
        ]);
        App\Model\StatusProduct::create([
            'statusName'=>'2da Mano - Casi Nuevo',
        ]);
        App\Model\StatusProduct::create([
            'statusName'=>'2da Mano - Muy Bueno',
        ]);
        App\Model\StatusProduct::create([
            'statusName'=>'2da Mano - Bueno',
        ]);
        App\Model\StatusProduct::create([
            'statusName'=>'bien',
        ]);
    }
}
