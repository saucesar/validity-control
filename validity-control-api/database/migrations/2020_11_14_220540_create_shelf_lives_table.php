<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShelfLivesTable extends Migration
{
    public function up()
    {
        Schema::create('shelf_lives', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->timestamp('date');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shelf_lives');
    }
}
