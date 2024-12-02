{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.student')

@section('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Student Dashboard</h1>

    <div class="card">
        <div class="card-body text-center">
            <h3 class="mb-3">Welcome, {{ Auth::user()->name }}</h3>

            <p>Use the menu below to navigate:</p>

            <div class="list-group">
                <a href="{{ route('vehicles.index') }}" class="list-group-item list-group-item-action">
                    Manage Your Vehicle
                </a>
                <a href="{{ route('stickers.index') }}" class="list-group-item list-group-item-action">
                    Manage Your Sticker
                </a>
                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                    Complete Your Profile
                </a>
                {{-- Add other links as needed for other student features --}}
                <a href="#" class="list-group-item list-group-item-action">
                    Example Feature (Coming Soon)
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for mobile responsiveness */
    .container {
        max-width: 100%;
        padding: 0 1rem;
    }
    h1 {
        font-size: 1.8rem;
    }
    h3 {
        font-size: 1.4rem;
    }
    p {
        font-size: 1rem;
    }
    .list-group-item {
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }
</style>

@endsection
