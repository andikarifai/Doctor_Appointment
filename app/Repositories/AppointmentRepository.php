<?php   
namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{
    public function getAllAppointments()
    {
        return Appointment::where('user_id', auth()->id())->get();
    }

    public function findAppointmentById($id)
    {
        return Appointment::where('id', $id)->where('user_id', auth()->id())->first();
    }

    public function createAppointment(array $data)
    {
        return Appointment::create($data);
    }

    public function updateAppointment(Appointment $appointment, array $data)
    {
        return $appointment->update($data);
    }

    public function deleteAppointment(Appointment $appointment)
    {
        return $appointment->delete();
    }
}
