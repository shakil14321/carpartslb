<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('front.pages.password-reset');
    }

    // send reset code
    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if(!$user) return back()->withErrors(['email' => 'Email not found.']);

        $length = rand(6,8);
        $token = strtoupper(Str::random($length));
        if (!preg_match('/\d/', $token)) {
            $token = substr_replace($token, rand(0,9), 0, 1);
        }

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($user->email)->send(new ResetPasswordCode($token, $user->name));
        return redirect()->route('password.verify.form')->with('success', 'Reset code sent.');
    }

    public function showVerifyForm()
    {
        return view('front.pages.password-reset-verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string'
        ]);

        $row = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if(!$row) return back()->withErrors(['email' => 'No reset request found.']);

        if ($row->token !== $request->token) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }

        if (now()->diffInMinutes($row->created_at) > 20) {
            return back()->withErrors(['token' => 'Token expired.']);
        }

        // allow to show reset password form (we'll pass email+token)
        return view('front.pages.password-reset-update', ['email' => $request->email, 'token' => $request->token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => ['required','confirmed']
        ]);

        $row = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if(!$row || $row->token !== $request->token) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }

        if (now()->diffInMinutes($row->created_at) > 20) {
            return back()->withErrors(['token' => 'Token expired.']);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user) return back()->withErrors(['email' => 'User not found.']);

        $user->update(['password' => Hash::make($request->password)]);

        // delete token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login.form')->with('success', 'Password updated. You can now login.');
    }
}
