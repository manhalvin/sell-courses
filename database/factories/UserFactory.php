<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Enums\Status;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $avatar = new Avatar();
        return  [
            'name' => $this->faker->name,
            'username' => $this->faker->userName(),
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'mobile_no' => $this->faker->phoneNumber,
            'thumbnail' => $avatar->create($this->faker->name)->toBase64(),
            'status' => Status::Active,
            'role_id' => Role::User
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
