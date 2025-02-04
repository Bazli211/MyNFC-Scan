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
        $rules = [
            'user_type' => ['required', 'string', 'in:student,staff'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    
        if ($data['user_type'] == 'student') {
            $rules['matric_number'] = ['required', 'string', 'max:255', 'unique:users'];
        } else {
            $rules['staff_id'] = ['required', 'string', 'max:255', 'unique:users'];
        }
    
        return Validator::make($data, $rules);
    }
    
    protected function create(array $data)
    {
        if ($data['user_type'] == 'student') {
            return User::create([
                'name' => $data['name'],
                'matric_number' => $data['matric_number'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        } else {
            return User::create([
                'name' => $data['name'],
                'staff_id' => $data['staff_id'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }
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
