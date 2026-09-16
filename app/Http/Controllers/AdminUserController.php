<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('careHome')->orderBy('name');

        if ($search = $request->get('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // ─── Create Form ─────────────────────────────────────────────
    public function create()
    {
        if(auth()->user()->is_admin == 0){
            abort(403, 'Unauthorized — You do not have access to this area.');
        }
        return view('admin.users.create');
    }

    // ─── Store User Home ─────────────────────────────────────────
    public function store(Request $request)
    {
        if(auth()->user()->is_admin == 0){
            abort(403, 'Unauthorized — You do not have access to this area.');
        }
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'username'     => 'required|unique:users,username',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8',
            'address'      => 'required|string',
            'phone'        => 'nullable|string|max:30',
        ]);

        User::create([
            'name'         => $data['name'],
            'username'        => $data['username'],
            'email'        => $data['email'],
            'password'     => $data['password'],
            'address'        => $data['address'],
            'phone'        => $data['phone'],
            'role'         => 'admin',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'New User account created successfully.');
    }

    public function edit(User $user)
    {
        $careHomes = CareHome::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'careHomes'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'username'     => 'required|unique:users,username,' . $user->id,
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'role'         => 'required|in:admin,carehome',
            'care_home_id' => 'nullable|exists:care_homes,id',
            'password'     => 'nullable|string|min:8|confirmed',
            'is_active'    => 'sometimes|boolean',
        ]);

        $data = [
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => $request->role,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->role === 'carehome') {
            $data['care_home_id'] = $request->care_home_id;
        } else {
            $data['care_home_id'] = null;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'User updated successfully.');
    }
    
    public function deleteUser(User $user)
    {
        if (Auth::user()->is_admin == 0) {
            abort(403);
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
