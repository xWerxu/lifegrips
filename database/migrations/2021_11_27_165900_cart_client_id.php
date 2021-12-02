<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartClientId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign('cart_client_id_foreign');
            $table->dropColumn('client_id');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->constrained('users', 'id')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign('cart_client_id_foreign');
            $table->dropColumn('client_id');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable(false)->constrained('users', 'id')->onDelete('no action');
        });
    }
}
