<?php

// namespace App\Http\Controllers;

// use App\Models\Appointment;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;


// class AppointmentController extends Controller
// {
//     public function index()
//     {
//         $appointments = Appointment::where('user_id', Auth::id())->get();
//         return view('appointments.index', compact('appointments'));
//     }

//     public function create()
//     {
//         return view('appointments.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'doctor_name' => 'required',
//             'appointment_date' => 'required|date',
//             'notes' => 'nullable'
//         ]);

//         Appointment::create([
//             'user_id' => Auth::id(),
//             'doctor_name' => $request->doctor_name,
//             'appointment_date' => $request->appointment_date,
//             'notes' => $request->notes,
//         ]);

//         return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
//     }

//     public function edit(Appointment $appointment)
//     {
//         if ($appointment->user_id !== Auth::id()) {
//             return abort(403);
//         }

//         return view('appointments.edit', compact('appointment'));
//     }

//     public function update(Request $request, Appointment $appointment)
//     {
//         if ($appointment->user_id !== Auth::id()) {
//             return abort(403);
//         }

//         $request->validate([
//             'doctor_name' => 'required',
//             'appointment_date' => 'required|date',
//             'notes' => 'nullable'
//         ]);

//         $appointment->update($request->all());

//         return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
//     }

//     public function destroy(Appointment $appointment)
//     {
//         if ($appointment->user_id !== Auth::id()) {
//             return abort(403);
//         }

//         $appointment->delete();

//         return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        $appointments = $this->appointmentService->getAllAppointments();
        return view('appointments.index', compact('appointments'));
    }

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

        $this->appointmentService->createAppointment([
            'user_id' => auth()->id(),
            'doctor_name' => $request->doctor_name,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat!');
    }
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
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('appointments.index')->with('error', 'Anda tidak memiliki izin untuk menghapus janji temu ini.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dihapus!');
    }
}

