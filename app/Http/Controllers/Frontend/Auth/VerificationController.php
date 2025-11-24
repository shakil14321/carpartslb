<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function showForm()
    {
        return view('front.pages.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user->email) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        if ($user->isVerified()) {
            return redirect()->route('login.form')->with('success', 'Email already verified. Please login.');
        }

        if (is_null($user->verification_code) || is_null($user->code_expires_at)) {
            return back()->withErrors(['code' => 'No verification code found. Please request a new one.']);
        }

        if (now()->greaterThan($user->code_expires_at)) {
            return back()->withErrors(['code' => 'Code expired. Please request a new one.']);
        }

        if ($user->verification_code !== $request->code) {
            return back()->withErrors(['code' => 'Incorrect verification code.']);
        }

        // verify
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'code_expires_at' => null,
        ]);

        return redirect()->route('login.form')->with('success', 'Email verified. You can now login.');
    }

    public function resendView(){
        return view('front.pages.resend_code_verify_email');
    }

    // optional resend
    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if(!$user) return back()->withErrors(['email' => 'Email not found.']);

        $length = rand(6,8);
        $code = strtoupper(\Illuminate\Support\Str::random($length));
        if (!preg_match('/\d/', $code)) {
            $code = substr_replace($code, rand(0,9), 0, 1);
        }

        $user->update([
            'verification_code' => $code,
            'code_expires_at' => now()->addMinutes(20),
        ]);

        \Mail::to($user->email)->send(new \App\Mail\VerifyEmailCode($code, $user->name));
        return back()->with('success', 'New code sent to your email.');
    }
}
