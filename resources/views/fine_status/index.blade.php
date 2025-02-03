{{-- resources/views/fine_status/index.blade.php --}}
@extends('layouts.student')

@section('content')
<div class="container mt-4">
    <h2>Your Fine Status</h2>
    @if($statuses->isEmpty())
        <p>You have no fines at the moment.</p>
    @else
        <table class="table">
        <thead>
    <tr>
        <th>No</th>
        <th>Kesalahan</th>
        <th>Fine Details</th>
        <th>Fine Date</th>
        <th>Fine Time</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($statuses as $status)
        <tr>
            <td>{{  $status->id}}</td>
            <td>{{ $status->kesalahan }}</td>
            <td>{{ implode(', ', json_decode($status->fine_details)) }}</td>
            <td>{{ $status->fine_date }}</td>
            <td>{{ $status->fine_time }}</td>
            <td>{{ $status->fine_status }}</td>
            <td>
                <a href="{{ route('fine_status.show', $status->id) }}" class="btn btn-info">View</a>
            </td>
        </tr>
    @endforeach
</tbody>
        </table>
    @endif
</div>
@endsection

