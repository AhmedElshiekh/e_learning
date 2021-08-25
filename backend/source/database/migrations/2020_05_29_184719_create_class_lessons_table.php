<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('day')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('status')->default('in progress');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->boolean('student_canceled')->default(0);
            $table->boolean('teacher_canceled')->default(0);
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_lessons');
    }
}
