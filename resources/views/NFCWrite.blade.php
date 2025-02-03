@extends('layouts.police')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-center">Write NFC Sticker</h2>

            <div class="form-group">
                <label for="student_matricNum">Student Matric Number</label>
                <input type="text" id="student_matricNum" class="form-control" placeholder="Enter Student Matric Number" required>
            </div>

            <div class="form-group">
                <label for="sticker_date">Sticker Date</label>
                <input type="date" id="sticker_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="roadtax_date">Road Tax Date</label>
                <input type="date" id="roadtax_date" class="form-control" required>
            </div>

            <div class="text-center mt-3">
                <button id="writeNFC" class="btn btn-success">Write to NFC</button>
            </div>

            <div class="mt-4 alert alert-info" id="status" style="display: none;"></div>
        </div>
    </div>
</div>

<script src="{{ secure_asset('js/nfc_write.js') }}"></script>
@endsection
