<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    
    /**
     * related model
     *
     * @var Company
     */
    protected $model = Company::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'registration_number' => fake()->regexify('[0-9]{6}-[0-9]{4}'),
            'foundation_date' => fake()->date(),
            'country' => fake()->country(),
            'zip_code' => fake()->numberBetween(1, 5),
            'city' => fake()->city(),
            'street_address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'owner' => fake()->name(),
            'employees' => fake()->numberBetween(5, 200),
            'activity' => fake()->text(20),
            'active' => fake()->boolean(),
            'email' => fake()->email(),
            'password' => Hash::make(fake()->text(32))
        ];
    }
}
