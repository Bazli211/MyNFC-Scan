@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="p-4 bg-white shadow-md rounded-lg max-w-lg mx-auto">
    @csrf
    @method('PUT')

    <h2 class="text-xl font-bold mb-4">Edit Vehicle Details</h2>

    <div class="mb-4">
        <label for="vehiclePlateNum" class="block text-gray-700 font-semibold">Vehicle Plate Number</label>
        <input type="text" id="vehiclePlateNum" name="vehiclePlateNum" value="{{ $vehicle->vehiclePlateNum }}" class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold">Vehicle Type</label>
        <div>
            <input type="radio" id="motorcycle" name="vehicle_type" value="motorcycle" class="vehicle-type" {{ $vehicle->vehicle_type == 'motorcycle' ? 'checked' : '' }}>
            <label for="motorcycle">Motorcycle</label>
            <input type="radio" id="car" name="vehicle_type" value="car" class="vehicle-type" {{ $vehicle->vehicle_type == 'car' ? 'checked' : '' }}>
            <label for="car">Car</label>
        </div>
    </div>

    <div class="mb-4 hidden" id="motorcycle_model_div">
        <label for="motorcycle_model" class="block text-gray-700 font-semibold">Motorcycle Model</label>
        <input type="text" id="motorcycle_model" name="motorcycle_model" class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div class="mb-4 hidden" id="car_model_div">
        <label for="car_model" class="block text-gray-700 font-semibold">Car Model</label>
        <input type="text" id="car_model" name="car_model" class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div class="mb-4">
        <label for="vehicle_brand" class="block text-gray-700 font-semibold">Vehicle Brand</label>
        <select id="vehicle_brand" name="vehicle_brand" class="w-full px-3 py-2 border rounded-lg">
            <option value="">Select a brand</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="sticker_date" class="block text-gray-700 font-semibold">Sticker Date</label>
        <input type="text" id="sticker_date" name="sticker_date" value="{{ $vehicle->sticker_date }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed" readonly>
    </div>

    <div class="mb-4">
        <label for="roadtax_date" class="block text-gray-700 font-semibold">Road Tax Date</label>
        <input type="date" id="roadtax_date" name="roadtax_date" value="{{ $vehicle->roadtax_date }}" class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div class="mb-4">
        <label for="vehicle_color" class="block text-gray-700 font-semibold">Vehicle Color</label>
        <input type="text" id="vehicle_color" name="vehicle_color" value="{{ $vehicle->vehicle_color }}" class="w-full px-3 py-2 border rounded-lg">
    </div>

    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Vehicle</button>
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
            const motorcycleModelDiv = document.getElementById('motorcycle_model_div');
            const carModelDiv = document.getElementById('car_model_div');
            
            // Show/Hide model input fields
            motorcycleModelDiv.classList.add('hidden');
            carModelDiv.classList.add('hidden');
            if (type === 'motorcycle') {
                motorcycleModelDiv.classList.remove('hidden');
            } else if (type === 'car') {
                carModelDiv.classList.remove('hidden');
            }

            // Populate vehicle brand dropdown
            brandSelect.innerHTML = '<option value="">Select a brand</option>'; // Clear current options
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
