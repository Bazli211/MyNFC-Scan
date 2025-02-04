@extends('layouts.police')
<style>

input[readonly] {
            background-color: #f8f9fa;
            color: #495057;
            cursor: not-allowed;
        }
</style>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <h2 class="mb-4 text-center">Edit Fine</h2>
            <form action="{{ route('fines.update', $fine->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Student Matric Number -->
                <div class="form-group">
                    <label for="student_matricNum">Student Matric Number</label>
                    <input type="text" class="form-control" id="student_matricNum" name="student_matricNum"
                        value="{{ old('student_matricNum', $fine->student_matricNum) }}" readonly>
                </div>

                <!-- Sticker ID -->
                <div class="form-group">
                    <label for="sticker_id">Sticker ID</label>
                    <input type="text" class="form-control" id="sticker_id" name="sticker_id"
                        value="{{ old('sticker_id', $fine->sticker_id) }}" readonly>
                </div>

                <!-- Session -->
                <div class="form-group">
                    <label for="Session">Session Year</label>
                    <input type="text" class="form-control" id="session" name="session"
                        value="{{  old('session', $fine->session) }}">
                </div>

                <!-- Vehicle Plate Number -->
                <div class="form-group">
                    <label for="vehiclePlateNum">Vehicle Plate Number</label>
                    <input type="text" class="form-control" id="vehiclePlateNum" name="vehiclePlateNum"
                        value="{{ old('vehiclePlate', isset($fine->vehicle) ? $fine->vehicle->vehiclePlateNum : '') }}" readonly>
                </div>

               <!-- Vehicle Type -->
                <div class="form-group">
                    <label for="vehicle_type">Vehicle Type</label>
                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type"
                        value="{{ old('vehicle_type', isset($fine->vehicle) ? $fine->vehicle->vehicle_type : '') }}" readonly>
                </div>

                <!-- Vehicle Brand -->
                <div class="form-group">
                    <label for="vehicle_brand">Vehicle Brand</label>
                    <input type="text" class="form-control" id="vehicle_brand" name="vehicle_brand"
                            value="{{ old('vehicle_brand', isset($fine->vehicle) ? $fine->vehicle->vehicle_brand : '') }}" readonly>
                </div>

                <!-- Fine Date -->
<div class="form-group">
    <label for="fine_date">Fine Date</label>
    <input type="date" class="form-control" id="fine_date" name="fine_date"
        value="{{ old('fine_date', optional($fine->fine_date)->format('Y-m-d')) }}" readonly>
</div>

<!-- Fine Time -->
<div class="form-group">
    <label for="fine_time">Fine Time</label>
    <input type="time" class="form-control" id="fine_time" name="fine_time"
        value="{{ old('fine_time', optional($fine->fine_time)->format('H:i')) }}" readonly>
</div>

                <!-- Location -->
                <div class="form-group">
                    <label for="location">Location</label>
                    <select class="form-control" id="location" name="location" required>
                        <option value="" disabled>Select Location</option>
                        @foreach (['Al-Frb 1', 'Al-Frb 2', 'Al-Frb 3', 'Star', 'Dahlia', 'Cengal', 'Kesinai', 'Pusat Islam', 'Library', 'Pentadbiran'] as $location)
                            <option value="{{ $location }}" 
                                {{ old('location', $fine->location) == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kesalahan -->
                <div class="form-group">
                    <label for="kesalahan">Offenses</label>
                    @php
                        $kesalahanOptions = [
                            "1. MELETAK DI TEMPAT LARANGAN YANG DIKHASKAN",
                            "2. MELETAK DI LUAR PETAK/PETAK KUNING",
                            "3. MENGHALANG LALUAN",
                            "4. TIADA LESEN MEMANDU/TAMAT TEMPOH",
                            "5. LESEN L MEMBAWA PEMBONCENG",
                            "6. TIADA CUKAI JALAN YANG SAH/TAMAT TEMPOH ATAU TARIKH STICKER SUDAH TAMAT",
                            "7. MELANGGAR JALAN SEHALA/DILARANG MASUK",
                            "8. TIDAK MEMAKAI TOPI KELEDAR (PENUNGGANG/PEMBONCENG)",
                            "9. TIADA PELEKAT UITM SESI",
                            "10. MELETAK DI KORIDOR/LALUAN JALAN KAKI",
                            "11. KENDERAAN DIKUNCI",
                        ];
                        $selectedKesalahan = $fine->kesalahan ?? [];
    if (!is_array($selectedKesalahan)) {
        $selectedKesalahan = json_decode($selectedKesalahan, true) ?? [];
    }
@endphp

<!-- Then in your checkboxes -->
@foreach ($kesalahanOptions as $index => $kesalahan)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" 
               id="kesalahan_{{ $index }}" 
               name="kesalahan[]" 
               value="{{ $kesalahan }}"
               {{ in_array($kesalahan, old('kesalahan', $selectedKesalahan)) ? 'checked' : '' }}>
        <label class="form-check-label" for="kesalahan_{{ $index }}">
            {{ $kesalahan }}
        </label>
    </div>
@endforeach
                </div>

                 <!-- Nama Pelajar -->
            <div class="form-group">
                <label for="nama_pelajar">Student Name</label>
                <input type="text" class="form-control" id="nama_pelajar" name="nama_pelajar"
                    value="{{ old('nama_pelajar', isset($fine->student) ? $fine->student->name : '') }}" readonly>
            </div>


            <!-- Kod Program -->
            <div class="form-group">
                <label for="kod_program">Code Programme</label>
                <input type="text" class="form-control" id="kod_program" name="kod_program"
                    value="{{ old('kod_program', isset($fine->student) ? $fine->student->kod_program : '') }}" readonly>
            </div>

            <!-- Fakulti -->
            <div class="form-group">
                <label for="fakulti">Faculty</label>
                <input type="text" class="form-control" id="fakulti" name="fakulti"
                    value="{{ old('fakulti', isset($fine->student)?$fine->student->fakulti : '') }}" readonly>
            </div>

            <!-- Status Pelajar-->
            <div class="form-group">
                <label for="student_status">Student Status</label>
                <input type="text" class="form-control" id="student_status" name="student_status"
                    value="{{ old('student_status', isset($fine->student)?$fine->student->student_status : '') }}" readonly>
            </div>

            <!-- Kolej -->
            <div class="form-group">
                <label for="kolej">College</label>
                <input type="text" class="form-control" id="kolej" name="kolej"
                    value="{{ old('kolej', isset($fine->student)?$fine->student->kolej : '') }}" readonly>
            </div>

                <!-- Additional Fields -->
                <div class="form-group">
                    <label for="di_kunci_di_saman">Di Kunci / Di Saman</label>
                    <select class="form-control" id="di_kunci_di_saman" name="di_kunci_di_saman" required>
                        <option value="" disabled>Select Option</option>
                        <option value="Di Kunci" {{ old('di_kunci_di_saman', $fine->di_kunci_di_saman) == 'Di Kunci' ? 'selected' : '' }}>Di Kunci</option>
                        <option value="Di Saman" {{ old('di_kunci_di_saman', $fine->di_kunci_di_saman) == 'Di Saman' ? 'selected' : '' }}>Di Saman</option>
                    </select>
                </div>

                    <!-- Dikompaun -->
                    <div class="form-group">
                    <label for="dikompaun">Compounded</label>
                    <select class="form-control" id="dikompaun" name="dikompaun" required>
                        <option value="" disabled selected>Select Option</option>
                        <option value="Yes" {{ old('dikompaun', $fine->dikompaun ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('dikompaun', $fine->dikompaun ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Compounded Expiration -->
                <div class="form-group">
                <label for="compounded_expiration">Compounded Expiration Date</label>
                    <input type="date" class="form-control" id="compounded_expiration" name="compounded_expiration" 
                    value="{{ old('compounded_expiration', $fine->compounded_expiration ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $fine->comment) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Update Fine</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
