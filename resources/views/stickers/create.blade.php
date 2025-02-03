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
        <label for="requested_date">Sticker Application Date</label>
        <input type="date" name="requested_date" id="requested_date" class="form-control" value="{{ old('requested_date', $sticker->requested_date ?? now()->format('Y-m-d')) }}" required>
        <small class="form-text text-muted">
            It is recommended to select today's date for the best experience.
        </small>
    </div>

    {{-- Submit Button --}}
    <button type="submit" class="btn btn-primary mt-3">Renew Sticker</button>
</form>
</div>
@endsection


