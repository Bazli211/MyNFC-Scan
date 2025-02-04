@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

    <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
        @csrf
        @method('PUT') <!-- Important to send a PUT request -->

        <div class="form-group">
            <label for="vehiclePlateNum">Vehicle Plate Number</label>
            <input type="text" id="vehiclePlateNum" class="form-control @error('vehiclePlateNum') is-invalid @enderror" name="vehiclePlateNum" value="{{ old('vehiclePlateNum', $vehicle->vehiclePlateNum) }}" required>

            @error('vehiclePlateNum')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="vehicle_type">Vehicle Type</label>
            <div>
                <label>
                    <input type="radio" name="vehicle_type" value="motorcycle" class="vehicle-type" 
                    {{ old('vehicle_type', $vehicle->vehicle_type) == 'motorcycle' ? 'checked' : '' }} required>
                    Motorcycle
                </label>
                <label>
                    <input type="radio" name="vehicle_type" value="car" class="vehicle-type" 
                    {{ old('vehicle_type', $vehicle->vehicle_type) == 'car' ? 'checked' : '' }}>
                    Car
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="vehicle_brand">Vehicle Brand</label>
            <select id="vehicle_brand" name="vehicle_brand" class="form-control @error('vehicle_brand') is-invalid @enderror" required>
                <!-- Options will be dynamically populated -->
            </select>

            @error('vehicle_brand')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="sticker_date">Sticker Date</label>
            <input type="date" id="sticker_date" class="form-control" name="sticker_date" value="{{ $vehicle->sticker_date->format('Y-m-d') }}" readonly>
        </div>

        <div class="form-group">
            <label for="vehicle_color">Vehicle Color</label>
            <select id="vehicle_color" name="vehicle_color" class="form-control" required>
                <option value="Red" {{ old('vehicle_color', $vehicle->vehicle_color) == 'Red' ? 'selected' : '' }}>Red</option>
                <option value="Blue" {{ old('vehicle_color', $vehicle->vehicle_color) == 'Blue' ? 'selected' : '' }}>Blue</option>
                <option value="Black" {{ old('vehicle_color', $vehicle->vehicle_color) == 'Black' ? 'selected' : '' }}>Black</option>
                <option value="White" {{ old('vehicle_color', $vehicle->vehicle_color) == 'White' ? 'selected' : '' }}>White</option>
                <option value="Yellow" {{ old('vehicle_color', $vehicle->vehicle_color) == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="Green" {{ old('vehicle_color', $vehicle->vehicle_color) == 'Green' ? 'selected' : '' }}>Green</option>
            </select>
        </div>

        <div class="form-group">
            <label for="roadtax_date">Roadtax Date</label>
            <input type="date" id="roadtax_date" class="form-control @error('roadtax_date') is-invalid @enderror" name="roadtax_date" value="{{ old('roadtax_date', $vehicle->roadtax_date ? $vehicle->roadtax_date->format('Y-m-d') : '') }}" required>

            @error('roadtax_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
</div>

<script>
    const brands = {
        motorcycle: ['Honda', 'Yamaha', 'Suzuki', 'Modenas'],
        car: ['Toyota', 'Ford', 'BMW', 'Perodua', 'Proton', 'Hyundai', 'Honda']
    };

    document.querySelectorAll('.vehicle-type').forEach(radio => {
        radio.addEventListener('change', () => {
            const type = document.querySelector('input[name="vehicle_type"]:checked').value;
            const brandSelect = document.getElementById('vehicle_brand');

            // Populate vehicle brand dropdown
            brandSelect.innerHTML = ''; // Clear current options
            brands[type].forEach(brand => {
                const option = document.createElement('option');
                option.value = brand;
                option.textContent = brand;
                option.selected = "{{ old('vehicle_brand', $vehicle->vehicle_brand) }}" === brand;
                brandSelect.appendChild(option);
            });
        });
    });

    // Initialize on load
    window.onload = () => {
        const selectedType = "{{ old('vehicle_type', $vehicle->vehicle_type) }}";
        if (selectedType) {
            const event = new Event('change');
            document.querySelector(`input[value="${selectedType}"]`).dispatchEvent(event);
        }
    };
</script>
@endsection
