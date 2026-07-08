<?php

namespace Tests\Feature\Member;

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

        Role::firstOrCreate(['name' => 'Member']);
    }

    public function test_member_can_view_short_url_index()
    {
        $company = Company::factory()->create();

        $member = User::factory()->create([
            'company_id' => $company->id,
        ]);

        $member->assignRole('Member');

        $response = $this->actingAs($member)
            ->get(route('member.short-urls.index'));

        $response->assertOk();
    }
}