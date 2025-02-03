<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FineStatus;
use App\Fine;

class FineStatusController extends Controller
{
    public function index()
    {
        // Fetch fine statuses for the logged-in student
        $statuses = FineStatus::where('student_matricNumber', auth()->user()->matric_number)->get();
        return view('fine_status.index', compact('statuses'));
    }

    public function show($id)
    {
        $status = FineStatus::with('user')->findOrFail($id);
        return view('fine_status.show', compact('status'));
    }
    

    public function updateStatus(Request $request, $id)
{
    $status = FineStatus::findOrFail($id);
    $status->update(['fine_status' => $request->input('fine_status')]);

    return redirect()->route('fine_status.index')->with('success', 'Fine status updated successfully.');
}
}
