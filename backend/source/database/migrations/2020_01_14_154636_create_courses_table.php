<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Text('slug');
            $table->text('name');
            $table->Text('sh_desc');
            $table->longText('desc');
            $table->longText('contact')->nullable();
            $table->longText('prerequisite')->nullable();
            $table->bigInteger('level_id')->nullable();
            $table->boolean('status')->default(0);
            $table->bigInteger('course_cat_id')->nullable();
            $table->boolean('free')->default(false);
            $table->float('price')->nullable();
            $table->float('discountPrice')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->bigInteger('sub_cat_id')->unsigned()->nullable();
            $table->bigInteger('parent_cat_id')->unsigned()->nullable();
            $table->bigInteger('exam_id')->nullable();
            $table->bigInteger('placementTest_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
