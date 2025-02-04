@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="sticker_date">Sticker Date</label>
        <input type="text" id="sticker_date" name="sticker_date" value="{{ $vehicle->sticker_date }}" readonly>
    </div>

    <div>
        <label for="vehicle_brand">Vehicle Brand</label>
        <input type="text" id="vehicle_brand" name="vehicle_brand" value="{{ $vehicle->vehicle_brand }}" readonly>
    </div>

    <div>
        <label for="roadtax_date">Road Tax Date</label>
        <input type="date" id="roadtax_date" name="roadtax_date" value="{{ $vehicle->roadtax_date }}">
    </div>

    <div>
        <label for="vehicle_color">Vehicle Color</label>
        <input type="text" id="vehicle_color" name="vehicle_color" value="{{ $vehicle->vehicle_color }}">
    </div>

    <button type="submit">Update Vehicle</button>
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
