@extends('layouts.police')

@section('content')

<div class="container">
    <h1>Police Dashboard</h1>

    <div class="card">
        <div class="card-body">
            <h3>Welcome, {{ Auth::user()->name }}</h3>

            <p>Use the menu below to navigate:</p>

            <ul class="list-unstyled">
                <li><a href="{{ route('fines.index') }}" class="btn btn-primary btn-block mb-2">Manage Fine</a></li>
                <li><a href="{{ route('police.stickers.index') }}" class="btn btn-info btn-block mb-2">Manage Stickers</a></li>
                <li>
                    <a href="{{ route('nfc.scan') }}" class="btn btn-success btn-block mb-2">
                        NFC Scan for Fine
                    </a>
                </li>
                <li>
                    <a href="{{ route('nfc.write') }}" class="btn btn-warning btn-block">
                        Write NFC Sticker
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
