<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorksTable extends Migration
{
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('clients_id')->nullable();
            $table->foreign('clients_id', 'clients_fk_3132975')->references('id')->on('our_clients');
        });
    }
}
