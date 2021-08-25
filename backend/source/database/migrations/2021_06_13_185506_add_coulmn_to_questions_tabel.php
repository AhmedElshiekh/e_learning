<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulmnToQuestionsTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
             $table->unsignedBigInteger('lesson_id')->unsigned()->nullable();
             $table->unsignedBigInteger('chapter_id')->unsigned()->nullable();
             $table->unsignedBigInteger('course_id')->unsigned()->nullable();
             $table->unsignedBigInteger('class_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
}
