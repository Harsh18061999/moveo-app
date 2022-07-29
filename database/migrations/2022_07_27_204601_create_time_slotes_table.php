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
        Schema::create('time_slotes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('day');
            $table->string('start_end_time');
            $table->string('start_time');
            $table->string('end_time');
            $table->enum('status',['0','1'])->default('0');
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
        Schema::dropIfExists('time_slotes');
    }
};
