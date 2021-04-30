<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->double('price',8,2);
            $table->integer('pedido_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('pedido_id')->references('id')->on('pedido');
            $table->unique(['product_id','pedido_id']);
            $table->timestamps();
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
            $table->dropForeign('product_id');
            $table->dropForeign('pedido_id');
            $table->dropColumn('product_id');
            $table->dropColumn('pedido_id');
        });
        Schema::dropIfExists('carrito');
    }
}
