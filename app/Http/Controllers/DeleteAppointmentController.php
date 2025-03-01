<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteAppointmentController extends Controller
{
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('appointments.index')->with('error', 'Anda tidak memiliki izin untuk menghapus janji temu ini.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dihapus!');
    }
}
