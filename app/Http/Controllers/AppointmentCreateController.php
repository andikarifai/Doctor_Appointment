<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentCreateController extends Controller 
{
        public function create()
        {
            return view('appointments.create');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'doctor_name' => 'required|string|max:255',
                'appointment_date' => 'required|date',
                'notes' => 'nullable|string',
            ]);
    
            Appointment::create([
                'user_id' => auth()->id(),
                'doctor_name' => $request->doctor_name,
                'appointment_date' => $request->appointment_date,
                'notes' => $request->notes,
            ]);
    
            return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat!');
        }
}

