@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Daftar Janji Temu</h2>
    
    <a href="{{ route('appointments.create') }}" class="btn btn-success mb-3">Buat Janji Baru</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Tanggal</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $key => $appointment)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $appointment->doctor_name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->notes }}</td>
                <td>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
