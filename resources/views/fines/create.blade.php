@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Create New Fine</h2>
    <form action="{{ route('fines.store') }}" method="POST">
        @csrf

        @include('fines.form')

        <button type="submit" class="btn btn-primary">Create Fine</button>
    </form>
</div>
@endsection
