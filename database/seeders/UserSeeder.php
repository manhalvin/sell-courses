<?php

namespace Database\Seeders;

use App\Models\User;
use Laravolt\Avatar\Avatar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $avatar = new Avatar();
        User::insert([
            [
                'name' => 'Quốc Mạnh',
                'username' => 'quocmanh',
                'email' => 'quocmanh1998s@gmail.com',
                'password' => bcrypt('123456789'),
                'mobile_no' => '0961154483',
                'thumbnail' => $avatar->create('Quốc Mạnh')->toBase64(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
                'role_id' => 1,
            ],
            [
                'name' => 'Quốc Việt',
                'username' => 'quocviet',
                'email' => 'quocviet2001s@gmail.com',
                'password' => bcrypt('123456789'),
                'mobile_no' => '0914018077',
                'thumbnail' => $avatar->create('Quốc Việt')->toBase64(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
                'role_id' => 2,
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
