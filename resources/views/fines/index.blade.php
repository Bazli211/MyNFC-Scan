@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Fines</h2>
    <a href="{{ route('fines.create') }}" class="btn btn-primary">Create Fine</a>

    @include('fines.table') <!-- Include the table view here -->
</div>
@endsection
