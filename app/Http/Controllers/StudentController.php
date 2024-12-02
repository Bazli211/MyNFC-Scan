<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function editProfile()
    {
        $student = Auth::user();
        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kod_program' => 'required|string|max:255',
            'fakulti' => 'required|string|max:255',
            'kolej' => 'required|string|max:255',
        ]);

        $student = Auth::user();
        $student->update([
            'name' => $request->nama,
            'kod_program' => $request->kod_program,
            'fakulti' => $request->fakulti,
            'kolej' => $request->kolej,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
