<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->integer('statusProduct_id')->after('uniqueCode')->unsigned()->nullable();
            $table->foreign('statusProduct_id')->references('id')->on('status_products');
            // $table->boolean('hasChildren')->default(0)->after('statusProduct_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            // $table->dropColumn('hasChildren');
            $table->dropForeign(['statusProduct_id']);
            $table->dropColumn('statusProduct_id');
        });
    }
}
