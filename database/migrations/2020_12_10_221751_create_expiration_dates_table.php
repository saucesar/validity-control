<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpirationDatesTable extends Migration
{

    public function up()
    {
        Schema::create('expiration_dates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('amount');
            $table->string('lote')->nullable();

            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expiration_dates');
    }
}
