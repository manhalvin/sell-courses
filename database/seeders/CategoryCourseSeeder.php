<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Avatar;

class CategoryCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = new Avatar();
        DB::table('category_courses')->insert([
            [
                'name' => 'Thiết kế',
                'meta_keyword' => 'Thiết kế',
                'slug' => 'thiet-ke',
                'parent_id' => 0,
                'thumbnail' => $avatar->create('Thiết kế')->toBase64(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phần mềm thiết kế',
                'meta_keyword' => 'Phần mềm thiết kế',
                'slug' => 'phan-mem-thiet-ke',
                'parent_id' => 1,
                'thumbnail' => $avatar->create('Phần mềm thiết kế')->toBase64(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phần mềm photoshop',
                'meta_keyword' => 'Phần mềm photoshop',
                'slug' => 'phan-mem-photoshop',
                'parent_id' => 2,
                'thumbnail' => $avatar->create('Phần mềm photoshop')->toBase64(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
