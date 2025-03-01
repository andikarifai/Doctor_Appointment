<?php
namespace App\Services;

use App\Repositories\AppointmentRepository;
use App\Models\Appointment;

class AppointmentService
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getAllAppointments()
    {
        return $this->appointmentRepository->getAllAppointments();
    }

    public function createAppointment(array $data)
    {
        return $this->appointmentRepository->createAppointment($data);
    }

    public function updateAppointment(Appointment $appointment, array $data)
    {
        return $this->appointmentRepository->updateAppointment($appointment, $data);
    }

    public function deleteAppointment(Appointment $appointment)
    {
        return $this->appointmentRepository->deleteAppointment($appointment);
    }
}
