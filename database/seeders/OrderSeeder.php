<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                "id" => 46,
                "name" => "Trần Quốc Mạnh",
                "email" => "manhquoc1998s@gmail.com",
                "order_code" => "IS-74C881ZE",
                "total_quantify" => "1",
                "payment_method" => "home",
                "order_date" => Carbon::now('Asia/Ho_Chi_Minh'),
                "order_destroy" => Carbon::now('Asia/Ho_Chi_Minh'),
                "original_amount" => "799000",
                "discount_amount" => 0,
                "coupon_code" => "0",
                "final_amount" => "799000",
                "user_id" => 1,
                "status" => 1,
                "user_created" => "Trần Quốc Mạnh",
                "created_at" => Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at" => Carbon::now('Asia/Ho_Chi_Minh'),
            ],
            [
                "id" => 45,
                "name" => "Trần Quốc Mạnh",
                "email" => "manhquoc1998s@gmail.com",
                "order_code" => "IS-1JUIJWAB",
                "total_quantify" => "1",
                "payment_method" => "home",
                "order_date" => Carbon::now('Asia/Ho_Chi_Minh'),
                "order_destroy" => Carbon::now('Asia/Ho_Chi_Minh'),
                "original_amount" => "799000",
                "discount_amount" => "279650",
                "coupon_code" => "TET2023",
                "final_amount" => "519350",
                "user_id" => 1,
                "status" => 1,
                "user_created" => "Trần Quốc Mạnh",
                "created_at" => Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at" => Carbon::now('Asia/Ho_Chi_Minh'),
            ],
        ]);

    }
}
