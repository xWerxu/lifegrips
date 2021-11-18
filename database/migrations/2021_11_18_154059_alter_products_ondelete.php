<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_main_variant_foreign');
            $table->foreign('main_variant')
                ->references('id')
                ->on('variants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropForeign('products_main_variant_foreign');
            $table->foreign('main_variant')
                ->references('id')
                ->on('variants')
                ->onDelete('restrict');
        });
    }
}
