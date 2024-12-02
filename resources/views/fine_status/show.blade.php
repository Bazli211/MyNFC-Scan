{{-- resources/views/fine_status/show.blade.php --}}
@extends('layouts.student')

@section('content')
<div class="container mt-4">
    <h2>Fine Details</h2>
    <p><strong>Fine Details:</strong> {{ implode(', ', json_decode($status->fine_details)) }}</p>
    <p><strong>Fine Date:</strong> {{ $status->fine_date }}</p>
    <p><strong>Fine Time:</strong> {{ $status->fine_time }}</p>
    <p><strong>Status:</strong> {{ $status->fine_status }}</p>
    <a href="{{ route('fine_status.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
