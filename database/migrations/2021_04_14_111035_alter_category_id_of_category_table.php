<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoryIdOfCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
            $table->dropForeign(['statusProduct_id']);
            $table->foreign('statusProduct_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('carrito', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('characteristics', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->dropForeign(['permission_id']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->foreign('role_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')->references('id')->on('category');
            $table->dropForeign(['statusProduct_id']);
            $table->foreign('statusProduct_id')->references('id')->on('product');
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('product');
        });
        Schema::table('carrito', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product');
        });
        Schema::table('characteristics', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('product');
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->dropForeign(['permission_id']);
            $table->foreign('permission_id')->references('id')->on('permissions');
        });
    }
}
