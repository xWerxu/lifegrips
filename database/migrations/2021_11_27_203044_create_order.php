<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->unique()->constrained('cart', 'id');
            $table->foreignId('shipment_id')->constrained('shipment', 'id');
            $table->foreignId('coupon_id')->nullable()->constrained('coupon', 'id');
            $table->integer('status')->default(0);
            $table->decimal('total_price', 10);
            $table->date('completed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
