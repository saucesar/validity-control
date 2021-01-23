<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmountInOutsTable extends Migration
{

    public function up()
    {
        Schema::create('amount_in_outs', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->enum('type', ['in', 'out']);
            $table->string('reason')->nullable();

            $table->integer('exp_date_id');
            $table->foreign('exp_date_id')->references('id')->on('expiration_dates')->onDelete('cascade');

            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('amount_in_outs');
    }
}
