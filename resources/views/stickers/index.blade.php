@extends('layouts.student')

@section('content')
<div class="container">
    <h1>Your Sticker Requests</h1>

    @if ($stickers->isEmpty())
        <div class="alert alert-warning">
            <p>You haven't created any stickers yet. Click the button below to request a new sticker.</p>
            <a href="{{ route('stickers.create') }}" class="btn btn-primary">Create Sticker</a>
        </div>
    @else
        @foreach ($stickers as $sticker)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Sticker ID: {{ $sticker->unique_id }}</h5>
                    <p>Status: {{ $sticker->status_sticker }}</p>
                    <p>Requested Date: {{ $sticker->requested_date }}</p>
                    <p>Accepted Date: {{ $sticker->accepted_date }}</p>
                    <p>Expired Date: {{ $sticker->expired_date }}</p>
                </div>
            </div>
        @endforeach
        <div class="mt-3 d-flex">
    {{-- Renew Sticker Button --}}
                <a href="{{ route('stickers.renew', $stickers->last()->unique_id) }}" class="btn btn-primary me-3">Renew Sticker</a>
    
    {{-- Create Another Sticker Button (only if the last sticker is rejected) --}}
            @if ($stickers->last()->status_sticker === 'rejected')
                <a href="{{ route('stickers.create') }}" class="btn btn-primary">Create Another Sticker</a>
        @endif
    </div>
    @endif
</div>
@endsection


