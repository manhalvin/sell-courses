<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostImagesTable extends Migration
{
    /**
     * Xóa bảng quản lý nhiều hình ảnh thuôc bài viết
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('path');

            $table->string('user_created')
                ->nullable();
            $table->string('user_updated')
                ->nullable();
            $table->string('user_deleted')
                ->nullable();
            $table->bigInteger('post_id')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Xóa bảng quản lý nhiều hình ảnh thuôc bài viết
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_images');
    }
}
