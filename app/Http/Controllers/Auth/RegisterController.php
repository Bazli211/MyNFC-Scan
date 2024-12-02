<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'matric_number' => 'nullable|string|max:20|unique:users',
            'staff_id' => 'nullable|string|max:20|unique:users',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'matric_number' => $data['matric_number'],
            'staff_id' => $data['staff_id'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        // Check if the user has a `staff_id` or `matric_number` to determine the redirect
        if ($user->staff_id) {
            return redirect()->route('police.dashboard'); // Route for police dashboard
        } elseif ($user->matric_number) {
            return redirect()->route('student.dashboard'); // Route for student dashboard
        }

        // Default redirect
        return redirect($this->redirectTo);
    }
}
