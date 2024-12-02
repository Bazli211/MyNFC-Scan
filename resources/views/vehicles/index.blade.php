{{-- resources/views/vehicles/index.blade.php --}}
@extends('layouts.student')

@section('content')
<div class="container">
    <h2>Your Vehicle Information</h2>

    @if ($vehicle)
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

        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit Vehicle</a>
    @else
        <p>You have not added any vehicle information yet.</p>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add Vehicle</a>
    @endif
</div>
@endsection
