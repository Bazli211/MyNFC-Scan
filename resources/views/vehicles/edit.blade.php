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
    <input type="text" id="vehicle_type" class="form-control" name="vehicle_type" 
           value="{{ ucfirst($vehicle->vehicle_type) }}" readonly>
        </div>

        <div class="form-group">
            <label for="vehicle_brand">Vehicle Brand</label>
            <input type="text" id="vehicle_brand" class="form-control @error('vehicle_brand') is-invalid @enderror" name="vehicle_brand" value="{{ old('vehicle_brand', $vehicle->vehicle_brand) }}" required>

            @error('vehicle_brand')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="sticker_date">Sticker Date</label>
            <input type="date" id="sticker_date" class="form-control" name="sticker_date" value="{{ $vehicle->sticker_date->format('Y-m-d') }}" readonly>
            <!-- No error handling needed as it's read-only -->
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
        <!-- Add more colors as needed -->
    </select>
</div>


        <div class="form-group">
            <label for="roadtax_date">Roadtax Date</label>
            <input type="date" id="roadtax_date" class="form-control @error('roadtax_date') is-invalid @enderror" name="roadtax_date" value="{{ old('roadtax_date', $vehicle->roadtax_date->format('Y-m-d')) }}" required>

            @error('roadtax_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
</div>
@endsection
