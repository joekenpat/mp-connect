<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
        // return [
        //     'name' => $this->faker->name(),
        //     'email' => $this->faker->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ];
        return [
            'email' => "Willemzy2002@gmail.com",
            'password' => Hash::make('password'),
            'first_name' => $this->faker->firstname(),
            'last_name' => $this->faker->lastname(),
            'profile_image' => '',
            'gender' => 'male',
            'nationality' => 'Nigerian',
            'current_address' => 'No 8 school road, Off Old Refinery, Elelenwo, Port Harcourt, Rivers State.',
            'mobile_phone' => '07062465404',
            'years_of_work_experience' => '3',
            'countries_of_work_experience' => '',
            'name_of_professional' => '',
            'utm_medium' => '',
            'hands_on_technology' => '',
            'topic_of_interests' => '',
            'areas_of_contribution' => '',
            'languages' => '',
            'short_bio' => $this->faker->sentence(),
            'date_of_birth' => '2022-05-12 13:22:25',
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
