@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Janji Temu Baru</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="doctor_name" class="form-label">Nama Dokter</label>
            <input type="text" class="form-control" id="doctor_name" name="doctor_name" required>
        </div>

        <div class="mb-3">
            <label for="appointment_date" class="form-label">Tanggal & Waktu Janji</label>
            <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan (Opsional)</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Janji Temu</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
