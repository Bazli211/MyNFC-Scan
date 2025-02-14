@extends('layouts.police')

@section('content')
<div class="container">
    <h2>Create New Fine</h2>
    <form action="{{ route('fines.store') }}" method="POST">
        @csrf

        <!-- Student Matric Number -->
        <div class="form-group">
            <label for="student_matricNum">Student Matric Number</label>
            <input type="text" class="form-control" id="student_matricNum" name="student_matricNum" 
                   value="{{ old('student_matricNum') }}" required>
        </div>

        <!-- Sticker ID -->
        <div class="form-group">
            <label for="sticker_id">Sticker ID</label>
            <input type="text" class="form-control" id="sticker_id" name="sticker_id" 
                   value="{{ old('sticker_id') }}" required>
        </div>

        <!-- Session -->
        <div class="form-group">
            <label for="session">Session Year</label>
            <input type="text" class="form-control" id="session" name="session" 
                   value="{{ old('session') }}">
        </div>

        <!-- Vehicle Plate Number -->
        <div class="form-group">
            <label for="vehiclePlateNum">Vehicle Plate Number</label>
            <input type="text" class="form-control" id="vehiclePlateNum" name="vehiclePlateNum" 
                   value="{{ old('vehiclePlateNum') }}">
        </div>

        <!-- Vehicle Type Selection -->
        <div class="form-group">
            <label for="vehicle_type">Vehicle Type</label>
            <div>
                <label>
                    <input type="radio" name="vehicle_type" value="motorcycle" class="vehicle-type" 
                           {{ old('vehicle_type') == 'motorcycle' ? 'checked' : '' }} required>
                    Motorcycle
                </label>
                <label>
                    <input type="radio" name="vehicle_type" value="car" class="vehicle-type" 
                           {{ old('vehicle_type') == 'car' ? 'checked' : '' }}>
                    Car
                </label>
            </div>
        </div>

        <!-- Vehicle Brand -->
        <div class="form-group">
            <label for="vehicle_brand">Vehicle Brand</label>
            <select id="vehicle_brand" name="vehicle_brand" class="form-control" required>
                <option value="" disabled selected>Select Vehicle Brand</option>
                <!-- Motorcycle Brands -->
                <optgroup label="Motorcycle Brands" class="motorcycle-brands">
                    @foreach(['Honda', 'Yamaha', 'Suzuki', 'Modenas'] as $brand)
                        <option value="{{ $brand }}" 
                                {{ old('vehicle_brand') == $brand ? 'selected' : '' }}
                                data-vehicle-type="motorcycle">
                            {{ $brand }}
                        </option>
                    @endforeach
                </optgroup>
                
                <!-- Car Brands -->
                <optgroup label="Car Brands" class="car-brands">
                    @foreach(['Toyota', 'Ford', 'BMW', 'Perodua', 'Proton', 'Hyundai'] as $brand)
                        <option value="{{ $brand }}" 
                                {{ old('vehicle_brand') == $brand ? 'selected' : '' }}
                                data-vehicle-type="car">
                            {{ $brand }}
                        </option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <!-- Fine Date -->
        <div class="form-group">
            <label for="fine_date">Fine Date</label>
            <input type="date" class="form-control" id="fine_date" name="fine_date" 
                   value="{{ old('fine_date', now()->format('Y-m-d')) }}" required>
        </div>

        <!-- Fine Time -->
        <div class="form-group">
            <label for="fine_time">Fine Time</label>
            <input type="time" class="form-control" id="fine_time" name="fine_time" 
                   value="{{ old('fine_time', now()->format('H:i')) }}" required>
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <select class="form-control" id="location" name="location" required>
                <option value="" disabled selected>Select Location</option>
                @php
                    $locations = [
                        "Al-Frb 1", "Al-Frb 2", "Al-Frb 3", "Star", 
                        "Dahlia", "Cengal", "Kesinai", "Pusat Islam", 
                        "Library", "Pentadbiran"
                    ];
                @endphp
                @foreach ($locations as $location)
                    <option value="{{ $location }}" 
                            {{ old('location') == $location ? 'selected' : '' }}>
                        {{ $location }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Kesalahan (Offenses) -->
        <div class="form-group">
            <label for="kesalahan">Kesalahan (Offenses)</label>
            <div id="kesalahan">
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
                @endphp
                @foreach ($kesalahanOptions as $kesalahan)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               id="kesalahan_{{ $loop->index }}" 
                               name="kesalahan[]" 
                               value="{{ $kesalahan }}" 
                               {{ in_array($kesalahan, old('kesalahan', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="kesalahan_{{ $loop->index }}">
                            {{ $kesalahan }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Nama Pelajar -->
        <div class="form-group">
            <label for="nama_pelajar">Nama Pelajar</label>
            <input type="text" class="form-control" id="nama_pelajar" name="nama_pelajar" 
                   value="{{ old('nama_pelajar') }}">
        </div>

        <!-- Kod Program -->
        <div class="form-group">
            <label for="kod_program">Kod Program</label>
            <input type="text" class="form-control" id="kod_program" name="kod_program" 
                   value="{{ old('kod_program') }}">
        </div>

        <!-- Fakulti -->
        <div class="form-group">
            <label for="fakulti">Faculty</label>
            <input type="text" class="form-control" id="fakulti" name="fakulti" 
                   value="{{ old('fakulti') }}">
        </div>
        
        <!-- Status Pelajar-->
        <div class="form-group">
            <label>Student Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="student_status" id="resident" 
                       value="Resident" {{ old('student_status') == 'Resident' ? 'checked' : '' }} required>
                <label class="form-check-label" for="resident">Resident</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="student_status" id="non_resident" 
                       value="Non-Resident" {{ old('student_status') == 'Non-Resident' ? 'checked' : '' }}>
                <label class="form-check-label" for="non_resident">Non-Resident</label>
            </div>
        </div>

        <!-- Kolej -->
        <div class="form-group" id="kolejGroup">
            <label for="kolej">Kolej <span class="text-danger" id="kolejRequired" style="display: none;">*</span></label>
            <input type="text" class="form-control" id="kolej" name="kolej" 
                   value="{{ old('kolej') }}">
        </div>

        <!-- Di Kunci / Di Saman -->
        <div class="form-group">
            <label for="di_kunci_di_saman">Di Kunci / Di Saman</label>
            <select class="form-control" id="di_kunci_di_saman" name="di_kunci_di_saman" required>
                <option value="" disabled selected>Select Option</option>
                <option value="Di Kunci" {{ old('di_kunci_di_saman') == 'Di Kunci' ? 'selected' : '' }}>Di Kunci</option>
                <option value="Di Saman" {{ old('di_kunci_di_saman') == 'Di Saman' ? 'selected' : '' }}>Di Saman</option>
            </select>
        </div>

        <!-- Dikompaun -->
        <div class="form-group">
            <label for="dikompaun">Dikompaun</label>
            <select class="form-control" id="dikompaun" name="dikompaun" required>
                <option value="" disabled selected>Select Option</option>
                <option value="Yes" {{ old('dikompaun') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('dikompaun') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Compounded Expiration -->
        <div class="form-group">
            <label for="compounded_expiration">Compounded Expiration Date</label>
            <input type="date" class="form-control" id="compounded_expiration" name="compounded_expiration" 
                   value="{{ old('compounded_expiration') }}">
        </div>

        <!-- Comment -->
        <div class="form-group">
            <label for="comment">Comment (Optional)</label>
            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Submit Fine</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vehicle Brand Filtering
    const vehicleTypeRadios = document.querySelectorAll('.vehicle-type');
    const vehicleBrandSelect = document.getElementById('vehicle_brand');
    
    function updateBrandOptions() {
        const selectedType = document.querySelector('.vehicle-type:checked')?.value;
        const options = vehicleBrandSelect.options;
        
        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            if (option.dataset.vehicleType) {
                const showOption = option.dataset.vehicleType === selectedType;
                option.style.display = showOption ? '' : 'none';
                option.disabled = !showOption;
            }
        }
        
        if (vehicleBrandSelect.value && 
            vehicleBrandSelect.selectedOptions[0].dataset.vehicleType !== selectedType) {
            vehicleBrandSelect.value = '';
        }
    }

    updateBrandOptions();
    vehicleTypeRadios.forEach(radio => radio.addEventListener('change', updateBrandOptions));

    // Kolej Requirement Toggle
    const statusRadios = document.querySelectorAll('input[name="student_status"]');
    const kolejInput = document.getElementById('kolej');
    const kolejRequired = document.getElementById('kolejRequired');

    function updateKolejRequirements() {
        const isResident = document.querySelector('input[name="student_status"]:checked')?.value === 'Resident';
        kolejInput.required = isResident;
        kolejRequired.style.display = isResident ? 'inline' : 'none';
        kolejInput.parentElement.classList.toggle('required-field', isResident);
    }

    updateKolejRequirements();
    statusRadios.forEach(radio => radio.addEventListener('change', updateKolejRequirements));
});
</script>
@endsection
