<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->string('note')->nullable();
            $table->time('sat')->nullable();
            $table->time('sun')->nullable();
            $table->time('mon')->nullable();
            $table->time('tue')->nullable();
            $table->time('wed')->nullable();
            $table->time('thu')->nullable();
            $table->time('fri')->nullable();
            $table->boolean('views')->default(0);
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
        Schema::dropIfExists('requests');
    }
}
