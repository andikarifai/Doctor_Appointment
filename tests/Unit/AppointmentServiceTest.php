<?php

// tests/Unit/AppointmentServiceTest.php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use App\Services\AppointmentService;
use Mockery;

class AppointmentServiceTest extends TestCase
{
    /** @test */
    public function it_can_create_appointment()
    {
        // Membuat mock AppointmentRepository
        $appointmentRepository = Mockery::mock(AppointmentRepository::class);
        
        // Menyatakan bahwa metode createAppointment dipanggil sekali
        $appointmentRepository->shouldReceive('createAppointment')
            ->once()
            ->andReturn(new Appointment());

        // Membuat instance AppointmentService dengan repository mock
        $service = new AppointmentService($appointmentRepository);

        // Data untuk appointment
        $data = [
            'doctor_name' => 'Dr. Smith',
            'appointment_date' => '2023-03-01 10:00:00',
            'notes' => 'Follow-up appointment',
        ];

        // Menguji apakah createAppointment bekerja dengan benar
        $appointment = $service->createAppointment($data);

        $this->assertInstanceOf(Appointment::class, $appointment);
    }
}
