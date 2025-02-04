{{-- resources/views/vehicles/index.blade.php --}}
@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Your Vehicle Information</h2>

{{-- Warning for expired road tax --}}
@if($warnings->isNotEmpty())
    <div class="alert alert-danger">
        <ul>
            @foreach($warnings as $warning)
                <li>{{ $warning }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($vehicle)
    {{-- Display vehicle details --}}
    <table class="table table-bordered">
    <tr>
        <th>Vehicle Plate Number</th>
        <td>{{ $vehicle->vehiclePlateNum }}</td>
    </tr>
    <tr>
        <th>Vehicle Brand</th>
        <td>{{ $vehicle->vehicle_brand }}</td>
    </tr>
    <tr>
        <th>Vehicle Type</th>
        <td>{{ $vehicle->vehicle_type }}</td>
    </tr>
    <tr>
        <th>Vehicle Model</th>
        <td>
            @if($vehicle->vehicle_type === 'motorcycle')
                {{ $vehicle->motorcycle_model }}
            @elseif($vehicle->vehicle_type === 'car')
                {{ $vehicle->car_model }}
            @else
                N/A
            @endif
        </td>
    </tr>
    <tr>
        <th>Sticker Date</th>
        <td>{{ $vehicle->sticker_date }}</td>
    </tr>
    <tr>
        <th>Vehicle Color</th>
        <td>{{ $vehicle->vehicle_color }}</td>
    </tr>
    <tr>
        <th>Road Tax Date</th>
        <td>{{ $vehicle->roadtax_date }}</td>
    </tr>
</table>

    {{-- Edit button --}}
   <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning" onclick="return confirmEdit(event)">Edit Vehicle</a>
@else
    {{-- Add vehicle logic --}}
    @if(!$warnings->contains('No sticker found.') && !$warnings->contains('Your sticker request is pending approval.'))
        {{-- Allow the user to add a vehicle if no sticker warnings exist --}}
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add Vehicle</a>
    @else
        {{-- Disable the button and show a warning when clicked --}}
        <button class="btn btn-primary" onclick="showStickerWarning()" type="button">Add Vehicle</button>
    @endif
@endif
@endsection
@section('scripts')
<script>
    function showStickerWarning() {
        let message = "You cannot add a vehicle because:\n";
        @if ($warnings->contains('No sticker found.'))
            message += "- No sticker found. Please apply for a sticker.\n";
        @endif
        @if ($warnings->contains('Your sticker request is pending approval.'))
            message += "- Your sticker request is pending approval.\n";
        @endif
        alert(message);
    }
    function confirmEdit(event) {
    event.preventDefault();
    const warningMessage = "Warning: You are about to modify vehicle details.\n\n" +
        "• All information must be accurate and up-to-date\n" +
        "• Misinformation may result in fines during police scans\n" +
        "• You're responsible for maintaining correct data\n\n" +
        "Proceed to edit vehicle details?";
    
    if (confirm(warningMessage)) {
        window.location.href = event.currentTarget.href;
        return true;
    }
    return false;
}
</script>
@endsection

