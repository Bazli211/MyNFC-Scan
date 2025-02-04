@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

      <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="p-4 bg-white shadow-md rounded-lg max-w-lg mx-auto">
    @csrf
    @method('PUT')

    <h2 class="text-xl font-bold mb-4">Edit Vehicle Details</h2>

    <div class="mb-4">
        <label for="sticker_date" class="block text-gray-700 font-semibold">Sticker Date</label>
        <input type="text" id="sticker_date" name="sticker_date" value="{{ $vehicle->sticker_date }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed" readonly>
    </div>

    <div class="mb-4">
        <label for="vehicle_brand" class="block text-gray-700 font-semibold">Vehicle Brand</label>
        <input type="text" id="vehicle_brand" name="vehicle_brand" value="{{ $vehicle->vehicle_brand }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed" readonly>
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
