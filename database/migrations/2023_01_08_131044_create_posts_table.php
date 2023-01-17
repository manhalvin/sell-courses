<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Tạo bảng bài viết giới thiệu về khóa học
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->text('thumbnail');
            $table->text('meta_keyword')
                ->nullable();
            $table->integer('status')
                ->nullable();
            $table->bigInteger('course_id')
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
     * Xóa bảng bài viết giới thiệu về khóa học
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
