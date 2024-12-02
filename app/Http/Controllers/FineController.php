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
    public function index()
    {
        $fines = Fine::all();
        return view('fines.index', compact('fines'));
    }

    // Show the form for creating a new fine
    public function create(Request $request)
    {
        $student_matricNum = $request->query('student_matricNum');
        
        $vehicle = Vehicle::where('student_matricNumber', $student_matricNum)->first();
        $user = User::where('matric_number', $student_matricNum)->first();
    
        return view('fines.create', [
            'fine' => new Fine([
                'student_matricNum' => $student_matricNum,
                'sticker_id' => $request->query('sticker_id'),
                'fine_date' => now()->format('Y-m-d'),
                'fine_time' => now()->format('H:i'),
                'vehicle_type' => $vehicle->vehicle_type ?? null,
                'vehicle_brand' => $vehicle->vehicle_brand ?? null,
                'nama_pelajar' => $user->name ?? null,
                'kod_program' => $user->kod_program ?? null,
                'fakulti' => $user->fakulti ?? null,
                'kolej' => $user->kolej ?? null,
            ]),
        ]);
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
        'vehicle_type' => 'nullable|string',
        'vehicle_brand' => 'nullable|string',
        'session' => 'nullable|string',
        'nama_pelajar' => 'nullable|string',
        'kod_program' => 'nullable|string',
        'fakulti' => 'nullable|string',
        'kolej' => 'nullable|string',
        'di_kunci_di_saman' => 'required|string',
        'dikompaun' => 'required|string',
        'compounded_expiration' => 'nullable|date',
    ]);

    Fine::create([
        'student_matricNum' => $request->student_matricNum,
        'sticker_id' => $request->sticker_id,
        'fine_date' => $request->fine_date,
        'location' => $request->location,
        'fine_time' => $request->fine_time,
        'comment' => $request->comment,
        'kesalahan' => $request->kesalahan, // Stored as JSON
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'session' => $request->session,
        'nama_pelajar' => $request->nama_pelajar,
        'kod_program' => $request->kod_program,
        'fakulti' => $request->fakulti,
        'kolej' => $request->kolej,
        'di_kunci_di_saman' => $request->di_kunci_di_saman,
        'dikompaun' => $request->dikompaun,
        'compounded_expiration' => $request->compounded_expiration,
    ]);

     // Create the fine status record
     FineStatus::create([
        'student_matricNumber' => $fine->student_matricNum,
        'fine_details' => json_encode($fine->kesalahan), // Convert the kesalahan array to JSON
        'fine_date' => $fine->fine_date,
        'fine_time' => $fine->fine_time,
        'fine_status' => 'Fined', // Default status
    ]);

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
        ]);
    }
    
   // Update the specified fine in storage
public function update(Request $request, Fine $fine)
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
        'vehicle_type' => 'nullable|string',
        'vehicle_brand' => 'nullable|string',
        'session' => 'nullable|string',
        'nama_pelajar' => 'nullable|string',
        'kod_program' => 'nullable|string',
        'fakulti' => 'nullable|string',
        'kolej' => 'nullable|string',
        'di_kunci_di_saman' => 'required|string',
        'dikompaun' => 'required|string',
        'compounded_expiration' => 'nullable|date',
    ]);

    $fine->update([
        'student_matricNum' => $request->student_matricNum,
        'sticker_id' => $request->sticker_id,
        'fine_date' => $request->fine_date,
        'location' => $request->location,
        'fine_time' => $request->fine_time,
        'comment' => $request->comment,
        'kesalahan' => $request->kesalahan, // Stored as JSON
        'vehicle_type' => $request->vehicle_type,
        'vehicle_brand' => $request->vehicle_brand,
        'session' => $request->session,
        'nama_pelajar' => $request->nama_pelajar,
        'kod_program' => $request->kod_program,
        'fakulti' => $request->fakulti,
        'kolej' => $request->kolej,
        'di_kunci_di_saman' => $request->di_kunci_di_saman,
        'dikompaun' => $request->dikompaun,
        'compounded_expiration' => $request->compounded_expiration,
    ]);

    return redirect()->route('fines.index')->with('success', 'Fine updated successfully.');
}

    

    // Remove the specified fine from storage
    public function destroy(Fine $fine)
    {
        $fine->delete();

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }
    public function scan(Request $request)
    {
        $request->validate([
            'nfc_data' => 'required|string',
        ]);
    
        // Search for the sticker by unique_id
        $sticker = Sticker::where('unique_id', $request->nfc_data)->first();
        if (!$sticker) {
            return response()->json(['message' => 'Sticker not found', 'data' => null], 404);
        }
    
        // Ensure the sticker is associated with a student
        $student = $sticker->student;
        if (!$student) {
            return response()->json(['message' => 'No student associated with this sticker', 'data' => null], 404);
        }
    
        return response()->json([
            'message' => 'NFC Data Retrieved Successfully',
            'data' => [
                'student_matricNum' => $student->matric_number,
                'sticker_id' => $sticker->unique_id,
            ],
        ]);
    }
    
}
