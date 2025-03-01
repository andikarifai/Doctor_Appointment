<?php

// tests/Feature/AppointmentControllerTest.php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_appointments_page()
    {
        // Buat user untuk login
        $user = User::factory()->create();

        // Autentikasi user
        $this->actingAs($user);

        // Buat appointment untuk pengujian
        Appointment::factory()->create();

        // Request halaman appointments
        $response = $this->get(route('appointments.index'));

        // Pastikan response sukses dan mengandung appointment
        $response->assertStatus(200);
        $response->assertSee('Appointment');
    }
}
