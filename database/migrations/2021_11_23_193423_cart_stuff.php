<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CartStuff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users', 'id')->onDelete('no action');
            $table->boolean('status')->default(false);
            
            $table->timestamps();
        });

        Schema::create('cart_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('variants')->onDelete('no action');
            $table->foreignId('cart_id')->constrained('cart')->onDelete('no action');
            $table->integer('quantity');
        });

        DB::statement('ALTER TABLE cart_item ADD CONSTRAINT check_quantity_amount CHECK (quantity > 0);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart');

        Schema::drop('cart_item');
    }
}
