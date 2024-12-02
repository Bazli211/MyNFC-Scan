@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Edit Fine</h2>
    <form action="{{ route('fines.update', $fine->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('fines.form')

        <button type="submit" class="btn btn-primary">Update Fine</button>
    </form>
</div>
@endsection
