@extends('layouts.student')

@section('content')
<div class="container">
    <h1>Your Sticker Requests</h1>
    @foreach ($stickers as $sticker)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $sticker->unique_id }}</h5> <!-- Use unique_id here -->
                <p>Status: {{ $sticker->status_sticker }}</p>
                <p>Validity: {{ $sticker->validity_date }}</p>
                <a href="{{ route('police.stickers.show', $sticker->unique_id) }}" class="btn btn-info">View Details</a>
            </div>
        </div>
    @endforeach
</div>
@endsection


