<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('postal_code', 16)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('phone_number', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table){
            $table->removeColumn('first_name');
            $table->removeColumn('last_name');
            $table->removeColumn('city');
            $table->removeColumn('postal_code');
            $table->removeColumn('address');
            $table->removeColumn('phone_number');
        });
    }
}
