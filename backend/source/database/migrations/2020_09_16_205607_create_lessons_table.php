<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Text('slug')->nullable();
            $table->text('topic');
            $table->Text('objective');
            $table->longText('summary')->nullable();
            $table->longText('material')->nullable();
            $table->text('video');
            $table->boolean('free')->default(0);
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->bigInteger('chapter_id')->unsigned()->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
