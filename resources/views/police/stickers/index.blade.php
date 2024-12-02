@extends('layouts.police')

@section('content')
<div class="container">
    <h1>Sticker Requests</h1>

    <form method="GET" action="{{ route('police.stickers.index') }}">
    <input type="text" name="search" placeholder="Search stickers" class="form-control mb-3" value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Unique ID</th>
            <th>Student Matric</th>
            <th>Validity Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stickers as $sticker)
            <tr>
                <td>{{ $sticker->id }}</td>
                <td>{{ $sticker->unique_id }}</td>
                <td>{{ $sticker->student_matricNumber }}</td>
                <td>{{ $sticker->validity_date }}</td>
                <td>{{ $sticker->status_sticker }}</td>
                <td>
                    <a href="{{ route('police.stickers.show', $sticker->id) }}" class="btn btn-info">Details</a>
                    @if($sticker->status_sticker === 'requested')
                        <form action="{{ route('police.stickers.approve', $sticker->unique_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('police.stickers.reject', $sticker->unique_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button class="btn btn-danger">Reject</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $stickers->links() }}
</div>
@endsection
