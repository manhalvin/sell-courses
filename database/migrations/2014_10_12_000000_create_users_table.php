<?php

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Tạo bảng users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->comment('name: họ tên người dùng');
            $table->string('username')
                ->comment('username: tên người dùng');
            $table->string('email');
            $table->string('password');
            $table->string('gender')
                ->comment('gender: Giới tính')
                ->nullable();
            $table->string('mobile_no')
                ->nullable();
            $table->text('address')
                ->nullable();
            $table->text('thumbnail')
                ->comment('thumbnail: Hình ảnh đại diện ')
                ->nullable();
            $table->boolean('status')
                ->default(Status::Inactive)
                ->comment('status: trạng thái tài khoản');
            $table->string('activation_date')
                ->nullable()
                ->comment('activate_date: ngày kích hoạt');
            $table->string('uuid')
                ->nullable();
            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('email_verified_at: email xác thực');
            $table->foreignId('role_id')
                ->nullable();

            $table->string('user_created')
                ->nullable();
            $table->string('user_updated')
                ->nullable();
            $table->string('user_deleted')
                ->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Xóa bảng users
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
