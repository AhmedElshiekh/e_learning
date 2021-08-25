<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned()->nullable();
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->bigInteger('course_id')->unsigned();
            $table->integer('weeks');
            $table->integer('session_number')->nullable();
            $table->integer('session_time');
            $table->date('start_from');
            $table->string('status')->default('open');
            // $table->enum('application',['zoom','teamLink']);
            $table->boolean('free')->default(0);
            $table->text('comment')->nullable();
            $table->boolean('student_approve')->default(0);
            $table->boolean('teacher_approve')->default(0);
            $table->boolean('private')->default(0);
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
        Schema::dropIfExists('classes');
    }
}
