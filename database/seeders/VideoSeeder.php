<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) {
            DB::table('course_episodes')->insert([
                [
                    'title' => time(). $i,
                    'content' => now(). $i,
                    'link_video' => now(). $i,
                    'episodes' => $i,
                    'course_id' => $i,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
