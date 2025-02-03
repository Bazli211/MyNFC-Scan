@extends('layouts.student')
@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Complete Your Profile</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Full Name</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $student->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="kod_program" class="form-label">Code Programme</label>
            <input type="text" name="kod_program" id="kod_program" class="form-control" value="{{ old('kod_program', $student->kod_program) }}" required>
        </div>
        <div class="mb-3">
            <label for="fakulti" class="form-label">Faculty</label>
            <input type="text" name="fakulti" id="fakulti" class="form-control" value="{{ old('fakulti', $student->fakulti) }}" required>
        </div>
        <div class="mb-3">
            <label for="kolej" class="form-label">College</label>
            <input type="text" name="kolej" id="kolej" class="form-control" value="{{ old('kolej', $student->kolej) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Student Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student_status" id="resident" value="Resident" 
                    {{ old('student_status', $student->student_status) == 'Resident' ? 'checked' : '' }} required>
                <label class="form-check-label" for="resident">
                    Resident
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student_status" id="non_resident" value="Non-Resident" 
                    {{ old('student_status', $student->student_status) == 'Non-Resident' ? 'checked' : '' }} required>
                <label class="form-check-label" for="non_resident">
                    Non-Resident
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
