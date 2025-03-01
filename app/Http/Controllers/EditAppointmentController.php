<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditAppointmentController extends Controller
{
    public function edit(Appointment $appointment)
    {
        // Pastikan hanya pemilik janji temu yang bisa mengedit
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('appointments.index')->with('error', 'Anda tidak memiliki izin untuk mengedit janji temu ini.');
        }

        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('appointments.index')->with('error', 'Anda tidak memiliki izin untuk mengedit janji temu ini.');
        }

        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $appointment->update([
            'doctor_name' => $request->doctor_name,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil diperbarui!');
    }
}
