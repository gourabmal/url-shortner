<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortUrlFactory extends Factory
{
    protected $model = ShortUrl::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),

            'created_by' => User::factory(),

            'destination_url' => fake()->url(),

            'code' => Str::random(6),

            'clicks' => 0,

            'is_active' => true,
        ];
    }
}