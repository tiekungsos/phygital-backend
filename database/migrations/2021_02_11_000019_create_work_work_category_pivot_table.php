<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkWorkCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('work_work_category', function (Blueprint $table) {
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id', 'work_id_fk_3132974')->references('id')->on('works')->onDelete('cascade');
            $table->unsignedBigInteger('work_category_id');
            $table->foreign('work_category_id', 'work_category_id_fk_3132974')->references('id')->on('work_categories')->onDelete('cascade');
        });
    }
}
