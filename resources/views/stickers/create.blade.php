@extends('layouts.student')

@section('content')
<div class="container">
    <h1>Request Sticker</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Sticker Request Form --}}
    <form action="{{ route('stickers.store') }}" method="POST">
        @csrf

        {{-- Validity Date --}}
        <div class="form-group">
            <label for="validity_date">Sticker Validity Date</label>
            <input type="date" name="validity_date" id="validity_date" class="form-control" required>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary mt-3">Request Sticker</button>
    </form>
</div>
@endsection

