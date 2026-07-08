<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'phone' => null,
                'profile_picture' => null,
                'password' => '12345678',
                'status' => 'Active',
            ]
        );

        $user->syncRoles(['SuperAdmin']);
    }
}