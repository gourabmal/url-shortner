<?php

namespace Tests\Feature\Admin;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShortUrlIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin']);
    }

    public function test_admin_can_view_short_url_index()
    {
        $company = Company::factory()->create();

        $admin = User::factory()->create([
            'company_id' => $company->id,
        ]);

        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)
            ->get(route('admin.short-urls.index'));

        $response->assertOk();
    }
}