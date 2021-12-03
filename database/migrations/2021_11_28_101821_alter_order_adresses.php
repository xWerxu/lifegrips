<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderAdresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string('city', 255);
            $table->string('zip', 255);
            $table->string('address', 255);
            $table->string('mail', 255);
            $table->string('phone', 16);
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
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('address');
            $table->dropColumn('mail');
            $table->dropColumn('phone');
        });
    }
}
