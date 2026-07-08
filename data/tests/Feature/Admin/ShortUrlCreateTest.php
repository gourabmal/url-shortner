<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class ShortUrlCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin']);
    }

    public function test_admin_can_create_short_url()
    {
        $company = Company::factory()->create();

        $admin = User::factory()->create([
            'company_id' => $company->id,
        ]);

        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)
            ->post(route('admin.short-urls.store'), [
                'destination_url' => 'https://google.com',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('short_urls', [
            'destination_url' => 'https://google.com',
        ]);
    }
}