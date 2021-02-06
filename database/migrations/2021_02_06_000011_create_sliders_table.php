<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header');
            $table->string('header_second');
            $table->string('status');
            $table->longText('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
