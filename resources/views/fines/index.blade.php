@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Fines</h2>
    <a href="{{ route('fines.manual') }}" class="btn btn-primary">Create Fine</a>
    <a href="{{ route('police.dashboard') }}" class="btn btn-primary">Back</a>

    <!-- Search Form -->
    <form method="GET" action="{{ route('fines.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search fines by matric number, date, or offence" value="{{ request()->search }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Search</button>
            </div>
        </div>
    </form>

    <!-- Include the table view -->
    @include('fines.table')
</div>
@endsection
