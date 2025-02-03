{{-- resources/views/fine_status/show.blade.php --}}
@extends('layouts.student')

@section('content')
<div class="container mt-4">
    <h2>Description of Fine</h2>
    <p><strong>No:</strong> {{ $status->id }}</p>
    <p><strong>Student Matric Number:</strong> {{ $status->student_matricNumber }}</p>
    <p><strong>Name:</strong> {{ $status->user->name ?? 'N/A' }}</p>
    <p><strong>Code Programme:</strong> {{ $status->user->kod_program ?? 'N/A' }}</p>
    <p><strong>Fakulti:</strong> {{ $status->user->fakulti ?? 'N/A' }}</p>
    <p><strong>College:</strong> {{ $status->user->kolej ?? 'N/A' }}</p>
    <p><strong>Offences:</strong> 
        {{ is_array($status->kesalahan) ? implode(', ', $status->kesalahan) : $status->kesalahan }}
    </p>
    <p><strong>Fine Description:</strong> 
        {{ is_array(json_decode($status->fine_details)) ? implode(', ', json_decode($status->fine_details)) : $status->fine_details }}
    </p>
    <p><strong>Fine Date:</strong> {{ $status->fine_date }}</p>
    <p><strong>Fine Time:</strong> {{ $status->fine_time }}</p>
    <p><strong>Status:</strong> {{ $status->fine_status }}</p>

    <a href="{{ route('fine_status.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
