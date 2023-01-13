<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Tạo bảng khóa học
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')
                ->nullable();
            $table->text('thumbnail');
            $table->string('price');
            $table->text('curriculum')
                ->nullable()
                ->comment('curriculum: giáo trình');
            $table->text('course_info')
                ->nullable();
            $table->bigInteger('category_course_id')
                ->nullable();

            $table->integer('status')
                ->nullable();
            $table->string('user_created')
                ->nullable();
            $table->string('user_updated')
                ->nullable();
            $table->string('user_deleted')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Xóa bảng khóa hoc
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
