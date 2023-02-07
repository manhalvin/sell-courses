<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\Status;
use Faker\Factory;
use App\Models\User;
use Laravolt\Avatar\Avatar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = new Avatar();
        User::insert([
            [
                'name' => 'Quốc Mạnh',
                'username' => 'quocmanh',
                'email' => 'manhquoc1998s@gmial.com',
                'password' => bcrypt('123456789'),
                'mobile_no' => '0961154483',
                'thumbnail' => $avatar->create('Quốc Mạnh')->toBase64(),
                'status' => Status::Active,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
                'role_id' => Role::Admin,
            ],
            [
                'name' => 'Quốc Việt',
                'username' => 'quocviet',
                'email' => 'quocviet2001s@gmail.com',
                'password' => bcrypt('123456789'),
                'mobile_no' => '0914018077',
                'thumbnail' => $avatar->create('Quốc Việt')->toBase64(),
                'status' => Status::Active,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
                'role_id' => Role::User,
            ],
        ]);

        User::factory(2000)->create();

        // $faker = Factory::create();
        // $data = array();
        // for ($i = 1; $i <= 600; $i++) {
        //     $user = new User();
        //     $user->name = $faker->name;
        //     $user->username = $faker->userName();
        //     $user->email = $faker->email;
        //     $user->password = Hash::make($faker->password);
        //     $user->mobile_no = $faker->phoneNumber;
        //     $user->thumbnail = $avatar->create($faker->name)->toBase64();
        //     $user->status = Status::Active;
        //     $user->created_at = date("m/d/Y");
        //     $user->updated_at = date("m/d/Y");
        //     $user->role_id = Role::User;
        //     $user->save();
        // }
    }
}
