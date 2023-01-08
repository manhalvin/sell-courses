<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Tạo bảng vai trò
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->comment('name: tên vai trò');
            $table->string('display_name')
                ->comment('display_name: mô tả vai trò')
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
     * Xóa bảng vai trò
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
