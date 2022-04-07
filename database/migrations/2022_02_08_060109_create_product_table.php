<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('colour_id')->references('id')->on('colour')->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('category')->cascadeOnDelete();
            $table->string ('name')->unique ();
            $table->string('status');
            $table->string('price');
            $table->string('stock');
            $table->string('upc')->unique;
            $table->string('url')->unique;
            $table->string('image');
            $table->string('path');
            $table->string('discription');
            $table->string('deleted_at');
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
        Schema::dropIfExists('product');
    }
}
