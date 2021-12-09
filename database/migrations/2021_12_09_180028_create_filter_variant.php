<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterVariant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_variant', function (Blueprint $table) {
            $table->foreignId('filter_id')->constrained('filter')->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('variants')->onDelete('cascade');
            $table->string('value', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_variant');
    }
}
