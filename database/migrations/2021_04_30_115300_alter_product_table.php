<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->boolean('enable')->default(1)->after('statusProduct_id');
            $table->boolean('enable_kg_per_price')->default(0)->after('enable');
            $table->enum('unidad_medida', ['unidad', 'kg','docena','caja'])->default('unidad')->after('enable_kg_per_price');
            $table->decimal('quantity',8,3)->change();
            $table->decimal('peso',8,3)->change();
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
            $table->dropColumn('enable');
            $table->dropColumn('enable_kg_per_price');
            $table->dropColumn('unidad_medida');
            $table->integer('quantity')->change();
            $table->string('peso')->change();
        });
    }
}
