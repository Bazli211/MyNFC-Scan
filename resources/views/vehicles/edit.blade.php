@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Edit Vehicle Information</h2>

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
        @csrf
        @method('PUT')

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

        <div id="motorcycle-form" class="additional-form" style="display: none;">
            <div class="form-group">
                <label for="motorcycle_model">Motorcycle Model</label>
                <input type="text" id="motorcycle_model" name="motorcycle_model" class="form-control" value="{{ old('motorcycle_model', $vehicle->motorcycle_model) }}">
            </div>
        </div>

        <div id="car-form" class="additional-form" style="display: none;">
            <div class="form-group">
                <label for="car_model">Car Model</label>
                <input type="text" id="car_model" name="car_model" class="form-control" value="{{ old('car_model', $vehicle->car_model) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="vehiclePlateNum">Vehicle Plate Number</label>
            <input type="text" name="vehiclePlateNum" class="form-control" value="{{ old('vehiclePlateNum', $vehicle->vehiclePlateNum) }}" required>
        </div>
        <div class="form-group">
            <label for="vehicle_brand">Vehicle Brand</label>
            <select id="vehicle_brand" name="vehicle_brand" class="form-control" required>
            </select>
        </div>
        <div class="form-group">
            <label for="sticker_date">Sticker Date</label>
            <input type="text" name="sticker_date" class="form-control" value="{{ $vehicle->sticker_date }}" readonly>
        </div>
        <div class="form-group">
            <label for="vehicle_color">Vehicle Color</label>
            <select id="vehicle_color" name="vehicle_color" class="form-control" required>
                <option value="red" {{ old('vehicle_color', $vehicle->vehicle_color) == 'red' ? 'selected' : '' }}>Red</option>
                <option value="blue" {{ old('vehicle_color', $vehicle->vehicle_color) == 'blue' ? 'selected' : '' }}>Blue</option>
                <option value="black" {{ old('vehicle_color', $vehicle->vehicle_color) == 'black' ? 'selected' : '' }}>Black</option>
                <option value="white" {{ old('vehicle_color', $vehicle->vehicle_color) == 'white' ? 'selected' : '' }}>White</option>
                <option value="yellow" {{ old('vehicle_color', $vehicle->vehicle_color) == 'yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="green" {{ old('vehicle_color', $vehicle->vehicle_color) == 'green' ? 'selected' : '' }}>Green</option>
            </select>
        </div>
        <div class="form-group">
            <label for="roadtax_date">Road Tax Date</label>
            <input type="date" name="roadtax_date" class="form-control" value="{{ old('roadtax_date', $vehicle->roadtax_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
            const motorcycleForm = document.getElementById('motorcycle-form');
            const carForm = document.getElementById('car-form');

            motorcycleForm.style.display = type === 'motorcycle' ? 'block' : 'none';
            carForm.style.display = type === 'car' ? 'block' : 'none';

            brandSelect.innerHTML = ''; 
            brands[type].forEach(brand => {
                const option = document.createElement('option');
                option.value = brand;
                option.textContent = brand;
                option.selected = "{{ old('vehicle_brand', $vehicle->vehicle_brand) }}" === brand;
                brandSelect.appendChild(option);
            });
        });
    });

    window.onload = () => {
        const selectedType = "{{ old('vehicle_type', $vehicle->vehicle_type) }}";
        if (selectedType) {
            document.querySelector(`input[value="${selectedType}"]`).dispatchEvent(new Event('change'));
        }
    };
</script>
@endsection
