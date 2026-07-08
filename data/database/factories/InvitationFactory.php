<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),

            'invited_by' => User::factory(),

            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'role' => fake()->randomElement([
                'Admin',
                'Member',
            ]),

            'token' => Str::random(64),

            'expires_at' => now()->addDays(7),

            'accepted_at' => null,

            'status' => 'Pending',
        ];
    }
}