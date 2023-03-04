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
        Schema::create('extra_toplists', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('portion_id');
            $table->unsignedMediumInteger('judge_id');
            $table->unsignedMediumInteger('event_id');
            $table->unsignedMediumInteger('candidate_id');
            $table->integer('candidate_number');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_toplists');
    }
};
