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
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $student->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="kod_program" class="form-label">Kod Program</label>
            <input type="text" name="kod_program" id="kod_program" class="form-control" value="{{ old('kod_program', $student->kod_program) }}" required>
        </div>
        <div class="mb-3">
            <label for="fakulti" class="form-label">Fakulti</label>
            <input type="text" name="fakulti" id="fakulti" class="form-control" value="{{ old('fakulti', $student->fakulti) }}" required>
        </div>
        <div class="mb-3">
            <label for="kolej" class="form-label">Kolej</label>
            <input type="text" name="kolej" id="kolej" class="form-control" value="{{ old('kolej', $student->kolej) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
