<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrito', function (Blueprint $table) {
            $table->decimal('quantity',8,3)->change();
            $table->enum('unidad_medida', ['unidad', 'kg','gr','lb','@',])->default('unidad')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrito', function (Blueprint $table) {
            $table->dropColumn('unidad_medida');
            $table->integer('quantity')->change();
        });

        //
    }
}
