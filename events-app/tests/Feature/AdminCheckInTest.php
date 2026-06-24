<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCheckInTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest cannot access check-in.
     */
    public function test_guest_cannot_access_check_in(): void
    {
        $response = $this->get(route('admin.check-in.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Non-admin attendee cannot access check-in.
     */
    public function test_attendee_cannot_access_check_in(): void
    {
        $user = User::factory()->create(['role' => 'attendee']);

        $response = $this->actingAs($user)->get(route('admin.check-in.index'));
        $response->assertStatus(403);
    }

    /**
     * Admin can view check-in page.
     */
    public function test_admin_can_access_check_in(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.check-in.index'));
        $response->assertStatus(200);
        $response->assertSee('Admin Check-in');
    }

    /**
     * Admin can successfully check-in using a registration code.
     */
    public function test_admin_can_check_in_with_valid_code(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $attendee = User::factory()->create(['role' => 'attendee']);
        $event = Event::create([
            'title' => 'Laravel Workshop',
            'description' => 'Hands-on Laravel Workshop',
            'location' => 'Room 101',
            'start_date' => now()->addDay(),
            'end_date' => now()->addDay()->addHours(2),
            'capacity' => 20,
            'is_published' => true,
        ]);

        $registration = Registration::create([
            'user_id' => $attendee->id,
            'event_id' => $event->id,
            'registration_code' => 'REG-TEST-123',
            'status' => 'confirmed',
            'is_checked_in' => false,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.check-in.process'), [
            'registration_code' => 'REG-TEST-123',
        ]);

        $response->assertRedirect(route('admin.check-in.index'));
        $response->assertSessionHas('success');
        
        $this->assertTrue($registration->fresh()->is_checked_in);
    }

    /**
     * Admin gets error with invalid code.
     */
    public function test_admin_gets_error_with_invalid_code(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.check-in.process'), [
            'registration_code' => 'REG-INVALID-999',
        ]);

        $response->assertRedirect(route('admin.check-in.index'));
        $response->assertSessionHas('error');
    }
}
