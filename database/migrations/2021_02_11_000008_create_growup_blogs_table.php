<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowupBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('growup_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_name');
            $table->string('name_write')->nullable();
            $table->longText('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
