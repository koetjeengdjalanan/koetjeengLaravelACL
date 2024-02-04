<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake();
        return [
            'profile_pictures' => 'https://source.unsplash.com/random/?selfie',
            'alternate_mail'   => $fake->unique()->safeEmail(),
            'birthday'         => $fake->dateTimeBetween('-53 Years', '-13 Years')->format('Y-m-d'),
            'country_code'     => $fake->countryCode(),
            'phone_number'     => $fake->e164PhoneNumber(),
            'address'          => $fake->address(),
            'about'            => $fake->text(255),
        ];
    }
}
