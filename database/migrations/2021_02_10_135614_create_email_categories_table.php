<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('email_categories', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_categories');
    }
}
