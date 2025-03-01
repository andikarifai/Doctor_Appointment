<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentCreateController;
use App\Http\Controllers\EditAppointmentController;
use App\Http\Controllers\DeleteAppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


Route::delete('appointments/{appointment}', [DeleteAppointmentController::class, 'destroy'])
    ->middleware('auth')
    ->name('appointments.destroy');

Route::get('appointments/{appointment}/edit', [EditAppointmentController::class, 'edit'])->middleware('auth')->name('appointments.edit');
Route::put('appointments/{appointment}', [EditAppointmentController::class, 'update'])->middleware('auth')->name('appointments.update');

Route::get('appointments/create', [AppointmentCreateController::class, 'create'])->middleware('auth')->name('appointments.create');
Route::post('appointments/store', [AppointmentCreateController::class, 'store'])->middleware('auth')->name('appointments.store');

Route::resource('appointments', AppointmentController::class)->except(['create', 'store'])->middleware('auth');


// Route::get('/', function () {
//     return redirect()->route('appointments.index');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});

require __DIR__.'/auth.php';
