<?php

namespace Tests\Feature\SuperAdmin;

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

        Role::firstOrCreate(['name' => 'SuperAdmin']);
    }

    public function test_super_admin_can_view_short_url_index()
    {
        $superAdmin = User::factory()->create();

        $superAdmin->assignRole('SuperAdmin');

        $response = $this->actingAs($superAdmin)
            ->get(route('superadmin.short-urls.index'));

        $response->assertOk();
    }
}