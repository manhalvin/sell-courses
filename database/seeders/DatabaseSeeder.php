<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoryCourseSeeder::class,
            CourseSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            VideoSeeder::class
        ]);

        // User::factory(100000)->create();
        // $this->call([
        //     UserSeeder::class,
        // ]);
    }
}
