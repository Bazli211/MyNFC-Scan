<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicle = Auth::user()->vehicle; // Retrieve the vehicle for the logged-in student
        return view('vehicles.index', compact('vehicle'));
    }
    

    public function create()
{
    $sticker = Auth::user()->sticker; // Fetch the sticker associated with the logged-in user

    if (!$sticker || $sticker->status_sticker !== 'approved') {
        return redirect()->route('vehicles.index')->with('error', 'Your sticker is not approved yet.');
    }

    $validityDate = $sticker->validity_date; // Fetch validity_date from the sticker

    return view('vehicles.create', compact('validityDate'));
}


public function store(Request $request)
{
    $sticker = Auth::user()->sticker;

    if (Auth::user()->vehicle) {
        return redirect()->route('vehicles.index')->with('error', 'You can only register one vehicle.');
    }    

    if (!$sticker || $sticker->status_sticker !== 'approved') {
        return redirect()->route('vehicles.index')->with('error', 'Your sticker is not approved yet.');
    }

    $request->validate([
        'vehiclePlateNum' => 'required|unique:vehicles,vehiclePlateNum',
        'vehicle_type' => 'required|in:motorcycle,car',
        'vehicle_brand' => 'required',
        'vehicle_color' => 'required',
        'roadtax_date' => 'required|date',
    ]);

    Vehicle::create([
        'vehiclePlateNum' => $request->vehiclePlateNum,
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'sticker_date' => $sticker->validity_date, // Automatically set sticker_date
        'vehicle_color' => $request->vehicle_color,
        'roadtax_date' => $request->roadtax_date,
        'student_matricNumber' => Auth::user()->matric_number,
    ]);

    return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
}


    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Check if the logged-in student owns this vehicle
        if ($vehicle->student_matricNumber !== Auth::user()->matric_number) {
            return redirect()->route('vehicles.index')->with('error', 'You are not authorized to update this vehicle.');
        }
    
        // Fetch the associated sticker for the logged-in student
        $sticker = Auth::user()->sticker;
    
        if (!$sticker || $sticker->status_sticker !== 'approved') {
            return redirect()->route('vehicles.index')->with('error', 'Your sticker is not approved or unavailable.');
        }
    
        // Normalize vehicle_type to lowercase
        $request->merge([
            'vehicle_type' => strtolower($request->vehicle_type),  // Normalize to lowercase
        ]);
    
        \Log::info('Request data for validation:', $request->all());
    
        // Validate the input
        $request->validate([
            'vehiclePlateNum' => 'required|unique:vehicles,vehiclePlateNum,' . $vehicle->id,
            'vehicle_type' => 'required|in:car,motorcycle',  // Check against lowercase values
            'vehicle_brand' => 'required',
            'vehicle_color' => 'required',
            'roadtax_date' => 'required|date',
        ]);
    
        // Update the vehicle details
        $vehicle->update([
            'vehiclePlateNum' => $request->vehiclePlateNum,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_brand' => $request->vehicle_brand,
            'sticker_date' => $sticker->validity_date, // Automatically update sticker_date
            'vehicle_color' => $request->vehicle_color,
            'roadtax_date' => $request->roadtax_date,
        ]);
    
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
{
    // Optionally, check if the authenticated user owns the vehicle before deleting
    if ($vehicle->student_matricNumber !== Auth::user()->matric_number) {
        return redirect()->route('vehicles.index')->with('error', 'You are not authorized to delete this vehicle.');
    }

    $vehicle->delete();
    return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
}
}

