<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail;

class AuthController extends Controller
{
    // ─── Show Login Page ─────────────────────────────────────────

    public function showLogin()
    {
        // dd(password_hash('1234', PASSWORD_DEFAULT));

        return view('auth.login');
    }

    // ─── Handle Login ────────────────────────────────────────────

    public function login(Request $request)
    {
        $request->validate([
            'username'    => 'required',
            'password' => 'required',
            'role'     => 'required|in:admin,carehome',
            'terms'    => 'required',
        ]);
        $credentials = $request->only('username', 'password', 'role');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (! Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account has been deactivated.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('carehome.dashboard');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    // ─── Show Register Page ──────────────────────────────────────

    public function showRegister()
    {
        $careHomes = CareHome::orderBy('name')->get();
        return view('auth.register', compact('careHomes'));
    }

    // ─── Handle Registration ─────────────────────────────────────

    public function register(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:8|confirmed',
            'care_home_id' => 'required|exists:care_homes,id',
        ]);

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => 'carehome',
            'care_home_id' => $request->care_home_id,
        ]);

        Auth::login($user);

        return redirect()->route('carehome.dashboard');
    }

    // ─── Logout ──────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ─── Show Password Reset Reset Page ────────────────────────────────────

    public function showPasswordResetReset()
    {
        return view('auth.password-reset-reset');
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->remember_token = Str::random(64);
        $user->save();

        $encryptedToken = Crypt::encrypt($user->remember_token);

        Mail::to($user->email)->send(new PasswordResetMail($user, $encryptedToken));
        // dd($encryptedToken, Mail::to($user->email)->send(new PasswordResetMail($user, $encryptedToken)));
        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showNewPasswordForm($encrypted_token)
    {
        try {
            $token = Crypt::decrypt($encrypted_token);
            $user = User::where('remember_token', $token)->first();

            if (! $user) {
                return redirect()->route('login')->withErrors(['email' => 'Invalid or expired token.']);
            }

            return view('auth.new-password', ['token' => $encrypted_token]);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Invalid token format.']);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $token = Crypt::decrypt($request->token);
            $user = User::where('remember_token', $token)->first();

            if (! $user) {
                return redirect()->route('login')->withErrors(['email' => 'Invalid or expired token.']);
            }

            $user->password = Hash::make($request->password);
            $user->remember_token = null; // Clear the token after use
            $user->save();

            return redirect()->route('login')->with('status', 'Password has been reset successfully!');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Something went wrong. Please try again.']);
        }
    }
    
}
