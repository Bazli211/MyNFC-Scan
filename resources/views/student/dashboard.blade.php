@extends('layouts.student')

@section('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Student Dashboard</h1>

    {{-- Instruction Section --}}
    <div class="alert alert-info">
        <h5 class="text-center">Important Instructions</h5>
        <p class="mb-0 text-center">
            Please ensure that your sticker is <strong>approved by the auxiliary police</strong> before attempting to register your vehicle. 
            You can manage your sticker applications through the <a href="{{ route('stickers.index') }}">Sticker Management</a> section.
        </p>
    </div>
{{-- New Instruction for Profile Completion --}}
<div class="alert alert-info">
    <h5 class="text-center">Profile Completion</h5>
    <p class="mb-0 text-center">
        Please ensure that your profile is <strong>complete</strong> to proceed with your vehicle registration. 
        You can update your profile details through the <a href="{{ route('profile.edit') }}">Profile Management</a> section.
    </p>
</div>
    @auth
        @php
            $vehicle = Auth::user()->vehicle;
            $sticker = Auth::user()->sticker;
        @endphp
        {{-- Warning for Vehicle --}}
        @if ($vehicle)
            @if ($vehicle->roadtax_date && \Carbon\Carbon::parse($vehicle->roadtax_date)->isPast())
                <div class="alert alert-danger text-center">
                    Your road tax has expired. Please renew it immediately.
                </div>
            @elseif (!$vehicle->roadtax_date)
                <div class="alert alert-warning text-center">
                    Please update your road tax information in the vehicle section.
                </div>
            @endif
        @else
            <div class="alert alert-info text-center">
                You have not registered a vehicle yet. Please ensure your sticker has been approved before registering. 
                <a href="{{ route('vehicles.index') }}">Register your vehicle here</a>.
            </div>
        @endif
    @endauth

    <div class="card">
        <div class="card-body text-center">
            <h3 class="mb-3">Welcome, {{ Auth::user()->name }}</h3>

            <p>Use the menu below to navigate:</p>

            <div class="list-group">
                <a href="{{ route('stickers.index') }}" class="list-group-item list-group-item-action">
                    Manage Your Sticker
                </a>
                <a href="{{ route('vehicles.index') }}" class="list-group-item list-group-item-action">
                    Manage Your Vehicle
                </a>
                <a href="{{ route('fine_status.index') }}" class="list-group-item list-group-item-action">
                    List of Offences
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
