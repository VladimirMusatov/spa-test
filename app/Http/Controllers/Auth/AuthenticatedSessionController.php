<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'grecaptchaResponse' => ['required', 'captcha'],
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){

            return response()->json([
                'success' => false,
                'message' => 'Authentication failed. Please check your credentials.', 
            ]);

        }

        return response()->json([            
            'success' => true,
            'message' => 'You have successfully logged',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

    }

    public function currentUser(Request $request)
    {
        if(Auth::check()){
            return response()->json([            
                'isAuthenticated' => true,
            ]);
        }else{
            return response()->json([            
                'isAuthenticated' => false,
            ]);
        }
    }

}
