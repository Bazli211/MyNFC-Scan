@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Fine Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Student Matric Number:</strong> {{ $fine->student_matricNum }}</p>
            <p><strong>Nama Pelajar:</strong> {{ $fine->nama_pelajar }}</p>
            <p><strong>Kod Program:</strong> {{ $fine->kod_program }}</p>
            <p><strong>Fakulti:</strong> {{ $fine->fakulti }}</p>
            <p><strong>Kolej:</strong> {{ $fine->kolej }}</p>
            <p><strong>Sticker ID:</strong> {{ $fine->sticker_id }}</p>
            <p><strong>Fine Date:</strong> {{ $fine->fine_date }}</p>
            <p><strong>Location:</strong> {{ $fine->location }}</p>
            <p><strong>Fine Time:</strong> {{ $fine->fine_time }}</p>
            <p><strong>Vehicle Type:</strong> {{ $fine->vehicle_type }}</p>
            <p><strong>Vehicle Brand:</strong> {{ $fine->vehicle_brand }}</p>
            <p><strong>Session:</strong> {{ $fine->session }}</p>
            <p><strong>Kesalahan:</strong></p>
            <ul>
                @if(is_array($fine->kesalahan))
                    @foreach($fine->kesalahan as $kesalahan)
                        <li>{{ $kesalahan }}</li>
                    @endforeach
                @else
                    <li>{{ $fine->kesalahan }}</li>
                @endif
            </ul>
            <p><strong>Comment:</strong> {{ $fine->comment }}</p>
            <p><strong>Di Kunci/Di Saman:</strong> {{ $fine->di_kunci_di_saman }}</p>
            <p><strong>Dikompaun:</strong> {{ $fine->dikompaun }}</p>
            <p><strong>Compounded Expiration:</strong> 
                {{ $fine->compounded_expiration ? $fine->compounded_expiration->format('Y-m-d') : '-' }}
            </p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('fines.edit', $fine->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('fines.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
