<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerchTagWorkPivotTable extends Migration
{
    public function up()
    {
        Schema::create('serch_tag_work', function (Blueprint $table) {
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id', 'work_id_fk_3135093')->references('id')->on('works')->onDelete('cascade');
            $table->unsignedBigInteger('serch_tag_id');
            $table->foreign('serch_tag_id', 'serch_tag_id_fk_3135093')->references('id')->on('serch_tags')->onDelete('cascade');
        });
    }
}
