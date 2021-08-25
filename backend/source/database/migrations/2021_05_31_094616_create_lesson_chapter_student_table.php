<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonChapterStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_chapter_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('chapter_id')->nullable();
            $table->bigInteger('lesson_id')->nullable();
            $table->bigInteger('classes_id')->nullable();
            $table->bigInteger('class_lesson_id')->nullable();
            $table->boolean('finish')->default(false);
            $table->boolean('open')->default(false);
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
        Schema::dropIfExists('lesson_chapter_student');
    }
}
