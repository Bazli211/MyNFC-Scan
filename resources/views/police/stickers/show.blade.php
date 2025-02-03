@extends('layouts.police')

@section('content')
<div class="container">
    <h1>Sticker Details</h1>
    <p>NO: {{$sticker->id}}</p>
    <p>Unique ID: {{ $sticker->unique_id }}</p> <!-- Use unique_id here -->
    <p>Student Matric: {{ $sticker->student_matricNumber }}</p>
    <p>Application Date: {{ $sticker->requested_date }}</p>
    <p>Accepted Date: {{ $sticker->accepted_date }}</p>
    <p>Expired Date: {{ $sticker->expired_date }}</p>
    <p>Status: {{ $sticker->status_sticker }}</p>

    @if($sticker->status_sticker === 'requested')
        <form action="{{ route('police.stickers.approve', $sticker->unique_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Approve</button>
        </form>
        <form action="{{ route('police.stickers.reject', $sticker->unique_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
    @endif
</div>
@endsection



