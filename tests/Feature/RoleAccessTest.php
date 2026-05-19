<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_pasien_cannot_access_staff_modules(): void
    {
        $user = User::factory()->create(['role' => 'pasien']);

        $this->actingAs($user)->get('/patients')->assertForbidden();
        $this->actingAs($user)->get('/medicines')->assertForbidden();
    }

    public function test_pasien_can_open_booking_page(): void
    {
        $user = User::factory()->create(['role' => 'pasien']);

        $this->actingAs($user)->get('/appointments/create')->assertOk();
    }

    public function test_dokter_can_access_patient_and_queue_modules(): void
    {
        $user = User::factory()->create(['role' => 'dokter']);

        $this->actingAs($user)->get('/patients')->assertOk();
        $this->actingAs($user)->get('/appointments')->assertOk();
    }
}
