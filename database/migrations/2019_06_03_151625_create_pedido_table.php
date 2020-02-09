<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado', ['carrito', 'confirmado', 'en_camino','entregado','anulado'])->default('carrito');
            $table->dateTime('fecha_entrega')->nullable();
            $table->dateTime('fecha_anulacion')->nullable();
            $table->string('motivo_anulacion')->nullable();
            $table->double('total', 8, 2)->default(0.00);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('pedido');
    }
}
