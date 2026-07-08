<?php

namespace Tests\Feature\Member;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShortUrlCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Member']);
    }

    public function test_member_can_create_short_url()
    {
        $company = Company::factory()->create();

        $member = User::factory()->create([
            'company_id' => $company->id,
        ]);

        $member->assignRole('Member');

        $response = $this->actingAs($member)
            ->post(route('member.short-urls.store'), [
                'destination_url' => 'https://google.com',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('short_urls', [
            'destination_url' => 'https://google.com',
            'created_by' => $member->id,
        ]);
    }
}