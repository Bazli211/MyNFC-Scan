<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this view exists
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login as matric_number
        $credentials = ['matric_number' => $request->identifier, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            return redirect()->route('student.dashboard'); // Redirect to student dashboard
        }

        // Attempt login as staff_id
        $credentials = ['staff_id' => $request->identifier, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            return redirect()->route('police.dashboard'); // Redirect to police dashboard
        }

        // If login attempt fails
        return back()->withErrors([
            'identifier' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    public function logout(Request $request)
{
    Auth::logout(); // Log out the user

    $request->session()->invalidate(); // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate the CSRF token

    return redirect('/'); // Redirect to the home page or any other desired page
}
protected function authenticated(Request $request, $user)
{
    if ($user->role === 'staff') {
        return redirect()->route('police.dashboard');
    } elseif ($user->role === 'student') {
        return redirect()->route('student.dashboard');
    }
    return redirect('/');
}

}
