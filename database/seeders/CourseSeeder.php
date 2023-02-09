<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Avatar;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = new Avatar();
        DB::table('courses')->insert([
            [
                'title' => 'Học Photoshop trọn bộ trong 7 ngày',
                'content' => 'Học thiết kế đồ họa chuyên nghiệp với Photoshop.',
                'slug' => 'hoc-photoshop-tron-do-trong-7-ngay',
                'price' => 799000,
                'thumbnail' => $avatar->create('Học Photoshop trọn bộ trong 7 ngày')->toBase64(),
                'status' => 1,
                'category_course_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Thiết kế Web với Photoshop',
                'content' => 'Học thiết kế Web với Photoshop và cách kiếm tiền từ công việc Freelance.',
                'slug' => 'thiet-ke-web-voi-photoshop',
                'price' => 699000,
                'thumbnail' => $avatar->create('Thiết kế Web với Photoshop')->toBase64(),
                'status' => 1,
                'category_course_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
