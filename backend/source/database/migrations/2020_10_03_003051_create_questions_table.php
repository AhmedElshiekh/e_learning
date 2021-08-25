<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Text('title');
            $table->bigInteger('sub_cat_id')->unsigned()->nullable();
            $table->bigInteger('parent_cat_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('level_id')->nullable();
            $table->float('score')->default(0);
            // $table->enum('type', ['boolean','choice', 'text']);
            $table->unsignedBigInteger('correct_answer')->nullable();

            // $table->unsignedBigInteger('lesson_id')->unsigned()->nullable();
            // $table->unsignedBigInteger('chapter_id')->unsigned()->nullable();
            // $table->unsignedBigInteger('course_id')->unsigned()->nullable();
            // $table->unsignedBigInteger('class_id')->unsigned()->nullable();
            // $table->foreign('correct_answer')->references('id')->on('answers')->onDelete('cascade');

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
        Schema::dropIfExists('questions');
    }
}
