<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $sticker = $user->stickers()
        ->orderBy('updated_at', 'desc') // Order by the latest update
        ->first();
    $vehicle = $user->vehicle; // Retrieve the vehicle for the logged-in student

    $warnings = collect(); // Create an empty collection for warnings

    // Check if road tax has expired or is about to expire
    if ($vehicle) {
        $roadtaxDate = \Carbon\Carbon::parse($vehicle->roadtax_date);
        $currentDate = \Carbon\Carbon::now();

        if ($roadtaxDate->isPast()) {
            $warnings->push('Your road tax has expired.');
        } elseif ($roadtaxDate->diffInDays($currentDate) <= 30) {
            $warnings->push('Your road tax will expire in less than 30 days.');
        }
    }

    // Check if the sticker is registered and approved
    if (!$sticker) {
        $warnings->push('No sticker found. Please apply for a sticker before adding a vehicle.');
    } elseif ($sticker->status_sticker !== 'approved') {
        $warnings->push('Your sticker request is pending approval. You cannot add a vehicle yet.');
    }

    return view('vehicles.index', compact('vehicle', 'warnings'));
}

    

public function create()
{
    \Log::info('Accessing create method.');

    $sticker = Auth::user()->stickers()->latest('updated_at')->first();

    if (!$sticker) {
        //\Log::info('No sticker found for the user.');
        return redirect()->route('vehicles.index')->with('error', 'No sticker record found. Please apply for a sticker.');
    }

    if ($sticker->status_sticker !== 'approved') {
        //\Log::info('Sticker not approved.');
        return redirect()->route('vehicles.index')->with('error', 'Your sticker request is not yet approved.');
    }

    $validityDate = $sticker->expired_date;

    //\Log::info('Sticker validity date:', ['validityDate' => $validityDate]);

    return view('vehicles.create', compact('validityDate'));
}

public function store(Request $request)
{
    $sticker = Auth::user()->stickers()
        ->where('status_sticker', 'approved')
        ->latest('updated_at')
        ->first();

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
        'motorcycle_model' => $request->vehicle_type === 'motorcycle' ? 'required' : 'nullable',
        'car_model' => $request->vehicle_type === 'car' ? 'required' : 'nullable',
        'vehicle_color' => 'required',
        'roadtax_date' => 'required|date',
    ]);

    Vehicle::create([
        'vehiclePlateNum' => $request->vehiclePlateNum,
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'motorcycle_model' => $request->vehicle_type === 'motorcycle' ? $request->motorcycle_model : null,
        'car_model' => $request->vehicle_type === 'car' ? $request->car_model : null,
        'sticker_date' => $sticker->expired_date,
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

    // Fetch the latest sticker for the logged-in student
    $sticker = Auth::user()->stickers()
        ->where('status_sticker', 'approved')
        ->latest('updated_at')
        ->first();

    // Check if a valid sticker exists
    if (!$sticker) {
        return redirect()->route('vehicles.index')->with('error', 'You need an approved sticker to update your vehicle.');
    }

    // Normalize vehicle_type to lowercase
    $request->merge([
        'vehicle_type' => strtolower($request->vehicle_type), // Normalize to lowercase
    ]);

   // \Log::info('Request data for validation:', $request->all());

    // Validate the input
    $request->validate([
        'roadtax_date' => 'required|date',
        'vehicle_color' => 'required|string|max:255',
    ]);

    // Update the vehicle details
    $vehicle->update([
        'roadtax_date' => $request->roadtax_date,
        'vehicle_color' => $request->vehicle_color,
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
