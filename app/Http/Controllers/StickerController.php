<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sticker;
use App\Vehicle;

class StickerController extends Controller
{
    // Student views their stickers
    public function index()
    {
        // Ensure only students can access this method
        if (!auth()->user()->matric_number) {
            abort(403, 'Unauthorized access.');
        }
    
        $stickers = Sticker::where('student_matricNumber', auth()->user()->matric_number)->get();
        return view('stickers.index', compact('stickers'));
    }
    


    // Student requests a sticker
    public function create()
    {
        return view('stickers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'requested_date' => 'required|date|after_or_equal:today',
    ]);

    Sticker::create([
        'unique_id' => Sticker::generateNextUniqueId(), // Use the generateNextUniqueId method to create unique_id
        'student_matricNumber' => auth()->user()->matric_number,
        'requested_date' => $request->requested_date,
        'status_sticker' => 'requested',
    ]);

    return redirect()->route('stickers.index')->with('success', 'Sticker requested successfully!');
}
    
    // Police view all stickers
    public function policeIndex(Request $request)
    {
        if (!auth()->user()->staff_id) {
            abort(403, 'Unauthorized access.');
        }
    
        $search = $request->input('search');
    
        $stickers = Sticker::query()
            ->when($search, function ($query) use ($search) {
                $query->where('student_matricNumber', 'like', "%{$search}%")
                      ->orWhere('unique_id', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('police.stickers.index', compact('stickers'));
    }
    

    // Police view sticker details
    public function show($id)
{
    // Fetch the sticker by its unique ID
    $sticker = Sticker::where('id', $id)->firstOrFail();

    return view('police.stickers.show', compact('sticker'));
}

public function approve($unique_id)
{
    $sticker = Sticker::where('unique_id', $unique_id)->first();

    if (!$sticker) {
        return redirect()->back()->with('error', 'Sticker not found.');
    }

    $sticker->update([
        'status_sticker' => Sticker::STATUS_APPROVED,
        'accepted_date' => now(),
        'expired_date' => now()->addYear(),
    ]);

    return redirect()->route('police.stickers.index')->with('success', 'Sticker approved successfully.');
}

public function reject($unique_id)
{
    $sticker = Sticker::where('unique_id', $unique_id)->first();

    if (!$sticker) {
        return redirect()->back()->with('error', 'Sticker not found.');
    }

    $sticker->status_sticker = 'rejected'; // Update status
    $sticker->save();

    return redirect()->route('police.stickers.index')->with('success', 'Sticker rejected successfully.');
}
public function renew($unique_id)
{
    $sticker = Sticker::where('unique_id', $unique_id)->firstOrFail();

    if ($sticker->expired_date > now()) {
        return redirect()->route('stickers.index')->with('error', 'This sticker is not eligible for renewal yet.');
    }

    return view('stickers.create', ['sticker' => $sticker]);
}
}
