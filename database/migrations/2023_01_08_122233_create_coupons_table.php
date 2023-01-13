<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Tạo bảng mã giảm giá
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')
                ->nullable();
            $table->string('code')
                ->nullable()
                ->comment('code: mã giảm giá');
            $table->string('date_start')
                ->nullable();
            $table->string('date_end')
                ->nullable();
            $table->string('time')
                ->nullable();
            $table->integer('quantify')
                ->nullable()
                ->comment('quantify: số lượng giảm giá');
            $table->string('condition')
                ->nullable()
                ->comment('condition: điều kiện giảm giá');

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
     * Xóa bảng mã giảm giá
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
