<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Tao bảng order
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('order_code');
            $table->string('total_quantify');
            $table->string('payment_method');
            $table->string('order_date');
            $table->string('order_destroy')
                ->nullable();
            $table->string('original_amount');
            $table->string('discount_amount');
            $table->string('coupon_code');
            $table->string('final_amount');
            $table->bigInteger('user_id')
                ->nullable();

            $table->string('status')
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
     * Xóa bảng order
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
