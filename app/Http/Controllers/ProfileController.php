<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'                  => 'required|string|max:255',
            'username'              => 'required|unique:users,username,' . $user->id,
            'email'                 => 'required|email|unique:users,email,' . $user->id,
            'phone'                 => 'nullable|string|max:30',
            'address'               => 'nullable|string',
            'current_password'      => 'required_with:new_password',
            'new_password'          => 'nullable|string|min:8|confirmed',
            'new_password_confirmation' => 'nullable|string|min:8',
        ]);

        // Verify current password if changing password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        }

        $data = [
            'name'    => $request->name,
            'username'=> $request->username,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}