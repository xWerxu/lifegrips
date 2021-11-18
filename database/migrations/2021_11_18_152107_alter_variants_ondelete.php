<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVariantsOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropForeign('variants_product_id_foreign');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_variant_id_foreign');
            $table->foreign('variant_id')
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
            $table->dropForeign('variants_product_id_foreign');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('no action');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_variant_id_foreign');
            $table->foreign('variant_id')
                ->references('id')
                ->on('variants')
                ->onDelete('restrict');
        });
    }
}
