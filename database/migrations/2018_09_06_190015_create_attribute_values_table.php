<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('product');
            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->integer('value_id')->unsigned();
            $table->foreign('value_id')->references('id')->on('values');
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
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropForeign(['attribute_id','value_id']);
            $table->dropColumn(['category_id','value_id']);
        });
        Schema::dropIfExists('attribute_values');
    }
}
