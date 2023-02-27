<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toplists', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('portion_id');
            $table->unsignedSmallInteger('candidate_id');
            $table->unsignedSmallInteger('event_id');
            $table->double('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toplists');
    }
};
