<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDuzo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment', function (Blueprint $table) {
            $table->boolean('available')->default(1);
        });

        Schema::table('payment', function (Blueprint $table) {
            $table->boolean('available')->default(1);
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->boolean('available')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment', function (Blueprint $table) {
            $table->dropColumn('available');
        });

        Schema::table('payment', function (Blueprint $table) {
            $table->dropColumn('available');
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->dropColumn('available');
        });
    }
}
