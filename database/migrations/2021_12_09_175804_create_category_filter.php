<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFilter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_filter', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->foreignId('filter_id')->constrained('filter', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_filter');
    }
}
