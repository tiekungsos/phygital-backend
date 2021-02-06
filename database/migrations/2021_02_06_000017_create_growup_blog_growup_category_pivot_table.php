<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowupBlogGrowupCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('growup_blog_growup_category', function (Blueprint $table) {
            $table->unsignedBigInteger('growup_blog_id');
            $table->foreign('growup_blog_id', 'growup_blog_id_fk_3132952')->references('id')->on('growup_blogs')->onDelete('cascade');
            $table->unsignedBigInteger('growup_category_id');
            $table->foreign('growup_category_id', 'growup_category_id_fk_3132952')->references('id')->on('growup_categories')->onDelete('cascade');
        });
    }
}
