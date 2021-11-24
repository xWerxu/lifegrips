<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->boolean('available');
            $table->string('name', 255);
            $table->integer('on_stock');
            $table->unsignedBigInteger('main_image_id')->nullable();
            $table->decimal('price')->nullable();
            $table->timestamps();

            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
