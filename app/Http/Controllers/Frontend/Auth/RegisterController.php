<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('front.pages.register');
    }

    public function register(Request $request)
    {
       $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/'
            ]
        ], [
            'password.required' => 'Please enter your password.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must be at least 6 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);


        // TODO: verify recaptcha server-side (see reCAPTCHA section below)
        // generate 6-8 char alphanumeric code
        $length = rand(6,8);
        $code = strtoupper(Str::random($length)); // letters+numbers
        // ensure contains number:
        if (!preg_match('/\d/', $code)) {
            $code = substr_replace($code, rand(0,9), 0, 1);
        }

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'customer',
            'verification_code' => $code,
            'code_expires_at' => now()->addMinutes(20),
        ]);

        // send verification email
        Mail::to($user->email)->send(new VerifyEmailCode($code, $user->name));

        return redirect()->route('verify.form')->with('success', 'Registration successful. Please check your email for the verification code.');
    }
}
