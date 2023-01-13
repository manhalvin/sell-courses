<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEpisodesTable extends Migration
{
    /**
     * Tạo bảng video khóa học
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')
                ->nullable();
            $table->text('link_video')
                ->nullable();
            $table->integer('episodes');
            $table->bigInteger('course_id')
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
     * Xóa bảng video khóa hoc
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_episodes');
    }
}
