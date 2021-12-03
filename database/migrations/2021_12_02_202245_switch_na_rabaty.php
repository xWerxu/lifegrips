<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SwitchNaRabaty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropConstrainedForeignId('coupon_id');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->constrained('coupon', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->constrained('coupon', 'id');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->dropConstrainedForeignId('coupon_id');
        });
    }
}
