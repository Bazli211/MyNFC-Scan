<?php

namespace App\Http\Controllers;

use App\Fine;
use App\Vehicle; // Include this if interacting with the vehicles table
use App\User;    // Include this if interacting with the users table
use App\Sticker; // Include this if interacting with the stickers table
use App\FineStatus; // Include this if interacting
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    // Display a listing of the fines
   // Updated index method in FineController
public function index(Request $request)
{
    $query = Fine::query();

    // Check for search criteria
    if ($request->filled('search')) {
        $query->where('student_matricNum', 'like', '%' . $request->search . '%')
              ->orWhere('fine_date', 'like', '%' . $request->search . '%')
              ->orWhere('kesalahan', 'like', '%' . $request->search . '%');
    }

    $fines = $query->get();

    return view('fines.index', compact('fines'));
}


    // Show the form for creating a new fine
   // app/Http/Controllers/FineController.php

public function create(Request $request)
{
    $student_matricNum = $request->query('student_matricNum');
    $stickerId = $request->query('sticker_id');

    // Debugging statement
    //\Log::info('Create Method:', ['student_matricNum' => $student_matricNum, 'sticker_id' => $stickerId]);


    $fine = new Fine([
        'student_matricNum' => $student_matricNum,
        'sticker_id' => $stickerId,
        'fine_date' => now()->format('Y-m-d'),
        'fine_time' => now()->format('H:i'),
    ]);

    // Load relationships
    $fine->load(['student', 'vehicle']);

    return view('fines.create', compact('fine'));
}
    

  // Store a newly created fine in storage
public function store(Request $request, Fine $fine)
{
    $request->validate([
        'student_matricNum' => 'required|exists:users,matric_number',
        'sticker_id' => 'required',
        'fine_date' => 'required|date',
        'location' => 'required|string',
        'fine_time' => 'required|date_format:H:i',
        'comment' => 'nullable|string',
        'kesalahan' => 'required|array',
        'kesalahan.*' => 'string',
        'vehiclePlateNum' => 'nullable|string',
        'vehicle_type' => 'nullable||in:motorcycle,car',
        'vehicle_brand' => 'nullable|string',
        'session' => 'nullable|string',
        'nama_pelajar' => 'nullable|string',
        'kod_program' => 'nullable|string',
        'fakulti' => 'nullable|string',
        'kolej' => 'nullable|string',
        'student_status' => 'nullable|string',
        'di_kunci_di_saman' => 'required|string',
        'dikompaun' => 'required|string',
        'compounded_expiration' => 'nullable|date',
    ]);
    if (is_null($request->student_matricNum)) {
        return redirect()->back()->withErrors(['student_matricNum' => 'Student Matric Number is required.']);}


    Fine::create([
        'student_matricNum' => $request->student_matricNum,
        'sticker_id' => $request->sticker_id,
        'fine_date' => $request->fine_date,
        'location' => $request->location,
        'fine_time' => $request->fine_time,
        'comment' => $request->comment,
        'kesalahan' => json_encode($request->kesalahan),  // Stored as JSON
        'vehiclePlateNum'=> $request->vehiclePlateNum,
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'session' => $request->session,
        'nama_pelajar' => $request->nama_pelajar,
        'kod_program' => $request->kod_program,
        'fakulti' => $request->fakulti,
        'kolej' => $request->kolej,
        'student_status' => $request->student_status,
        'di_kunci_di_saman' => $request->di_kunci_di_saman,
        'dikompaun' => $request->dikompaun,
        'compounded_expiration' => $request->compounded_expiration,
    ]);

    FineStatus::updateOrCreate(
        ['student_matricNumber' => $request->student_matricNum],
        [
            'fine_details' => json_encode($request->kesalahan),
            'fine_date' => $request->fine_date,
            'fine_time' => $request->fine_time,
            'fine_status' => 'Fined',
            'kesalahan' => json_encode($request->kesalahan),
            'nama_pelajar'=>$request->nama_pelajar,
            'kod_program'=>$request->kod_program,
            'fakulti'=>$request->fakulti,
            'kolej'=>$request->kolej,
        ]
    );
    //\Log::info('Student Matric Number:', ['student_matricNum' => $fine->student_matricNum]);
     // Create the fine status record
    
    return redirect()->route('fines.index')->with('success', 'Fine recorded successfully.');
}

    // Display the specified fine
    public function show(Fine $fine)
    {
        return view('fines.show', compact('fine'));
    }

    // Show the form for editing the specified fine
    public function edit(Fine $fine)
    {
        $vehicle = $fine->vehicle;
        $user = $fine->student;
    
        return view('fines.edit', [
            'fine' => $fine->load(['vehicle', 'student']),
            'vehicle_type' => $vehicle->vehicle_type ?? null,
            'vehicle_brand' => $vehicle->vehicle_brand ?? null,
            'nama_pelajar' => $user->name ?? null,
            'kod_program' => $user->kod_program ?? null,
            'fakulti' => $user->fakulti ?? null,
            'kolej' => $user->kolej ?? null,
            'student_status' => $user->student_status ?? null,
        ]);
    }
    
   // Update the specified fine in storage
public function update(Request $request, Fine $fine)
{
    //\Log::info('Update method called.');
    \Log::info('Submitted fine_time:', ['fine_time' => $request->fine_time]);
    try {
        $request->validate([
            'student_matricNum' => 'required|exists:users,matric_number',
            'sticker_id' => 'required',
            'fine_date' => 'required|date',
            'location' => 'required|string',
            'fine_time' => 'required|date_format:H:i',
            'comment' => 'nullable|string',
            'kesalahan' => 'required|array',
            'kesalahan.*' => 'string',
            'vehiclePlateNum' => 'nullable|string',
            'vehicle_type' => 'nullable|in:motorcycle,car',
            'vehicle_brand' => 'nullable|string',
            'session' => 'nullable|string',
            'nama_pelajar' => 'nullable|string',
            'kod_program' => 'nullable|string',
            'fakulti' => 'nullable|string',
            'kolej' => 'nullable|string',
            'student_status' => 'nullable|string',
            'di_kunci_di_saman' => 'required|string',
            'dikompaun' => 'required|string',
            'compounded_expiration' => 'nullable|date',
        ]);
        \Log::info('Validation passed successfully.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed.', $e->errors());
        dd($e->errors());
}
    //\Log::info('Validation passed successfully.');
    $fine->update([
        'student_matricNum' => $request->student_matricNum,
        'sticker_id' => $request->sticker_id,
        'fine_date' => $request->fine_date,
        'location' => $request->location,
        'fine_time' => $request->fine_time,
        'comment' => $request->comment,
        'kesalahan' => $request->kesalahan,  // Directly update as array if casted in model
        'vehiclePlateNum'=> $request->vehiclePlateNum,
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'session' => $request->session,
        'nama_pelajar' => $request->nama_pelajar,
        'kod_program' => $request->kod_program,
        'fakulti' => $request->fakulti,
        'kolej' => $request->kolej,
        'student_status' => $request->student_status,
        'di_kunci_di_saman' => $request->di_kunci_di_saman,
        'dikompaun' => $request->dikompaun,
        'compounded_expiration' => $request->compounded_expiration,
    ]);
    
    //\Log::info('Update Fine Request:', $request->all());
    //\Log::info('Fine updated successfully.', $fine->toArray());
    //\Log::info('Fine updated successfully.');
    //dd('Update method reached', $request->all());
    return redirect()->route('fines.index')->with('success', 'Fine updated successfully.');
    //\Log::info('Redirect executed.');
}

    

    // Remove the specified fine from storage
    public function destroy(Fine $fine)
    {
        $fine->delete();

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }

    public function manual()
{
    return view('fines.manual');
}


public function scan(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'student_matricNum' => 'required|string',
        'sticker_id' => 'required|string',
    ]);

   // \Log::info('NFC Data:', [
    //    'student_matricNum' => $request->student_matricNum,
    //    'sticker_id' => $request->sticker_id,
    //]);

    // Retrieve the sticker and related data
    $sticker = Sticker::where('unique_id', $request->sticker_id)->first();

    if (!$sticker) {
        return response()->json([
            'success' => false,
            'message' => 'Sticker not found or invalid.',
        ], 404);
    }

    // Fetch user or student information
    $student = User::where('matric_number', $request->student_matricNum)->first();

    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found.',
        ], 404);
    }

    // Fetch vehicle information
    $vehicle = Vehicle::where('student_matricNumber', $request->student_matricNum)->first();

    if (!$vehicle) {
        return response()->json([
            'success' => false,
            'message' => 'Vehicle not registered for the student.',
        ], 404);
    }

    // Validate expiration dates
    $roadtaxExpired = $vehicle->roadtax_date < now();
    $stickerExpired = $sticker->expired_date < now();

    if ($roadtaxExpired || $stickerExpired) {
        $message = [];
        if ($roadtaxExpired) {
            $message[] = "The road tax date ({$vehicle->roadtax_date->format('d-m-Y')}) has expired.";
        }
        if ($stickerExpired) {
            $message[] = "The sticker validity date ({$sticker->expired_date->format('d-m-Y')}) has expired.";
        }

        // Allow the fine to proceed
        return response()->json([
            'success' => true,
            'fine_required' => true,
            'message' => implode(' ', $message),
            'data' => [
                'student_matricNum' => $validated['student_matricNum'],
                'sticker_id' => $validated['sticker_id'],
                'roadtax_date' => $vehicle->roadtax_date->format('d-m-Y'),
                'expired_date' => $sticker->expired_date->format('d-m-Y'),
            ],
        ]);
    }
    else{
    // Return a success response when no fine is required
    return response()->json([
        'success' => true,
        'fine_required' => true,
        'data' => [
            'student_matricNum' => $validated['student_matricNum'],
            'sticker_id' => $validated['sticker_id'],
            'roadtax_date' => $vehicle->roadtax_date->format('d-m-Y'),
            'expired_date' => $sticker->expired_date->format('d-m-Y'),
        ],
    ]);
    }
}
}
