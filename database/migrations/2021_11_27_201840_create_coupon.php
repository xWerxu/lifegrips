<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->id();
            $table->string('coupon', 255)->unique();
            $table->boolean('shipment')->default(0);
            $table->integer('promotion')->default(0);
            $table->timestamps();
        });
        

        DB::statement(
            'ALTER TABLE coupon 
            ADD CONSTRAINT promotion_check CHECK (promotion >= 0 AND promotion <= 100)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
