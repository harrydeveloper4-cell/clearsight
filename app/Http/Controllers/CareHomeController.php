<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\Resident;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareHomeController extends Controller
{
    // ─── List All Care Homes ─────────────────────────────────────

    public function index()
    {
        $careHomes = CareHome::withCount([
            'activeResidents',
            'activeResidents as due_count'     => fn($q) => $q->where('status', 'due'),
            'activeResidents as overdue_count' => fn($q) => $q->where('status', 'overdue'),
        ])->latest()->get();

        return view('admin.care-homes.index', compact('careHomes'));
    }

    // ─── Show Single Care Home ───────────────────────────────────

    public function show(CareHome $careHome)
    {
        $residents = $careHome->activeResidents()->latest()->get();

        $requests = ServiceRequest::with('resident')
            ->where('care_home_id', $careHome->id)
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total'   => $residents->count(),
            'due'     => $residents->where('status', 'due')->count(),
            'overdue' => $residents->where('status', 'overdue')->count(),
        ];

        return view('admin.care-homes.show', compact('careHome', 'residents', 'requests', 'stats'));
    }

    // ─── Create Form ─────────────────────────────────────────────

    public function create()
    {
        return view('admin.care-homes.create');
    }

    // ─── Store Care Home ─────────────────────────────────────────

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string',
            'manager_name' => 'required|string|max:255',
            'username'     => 'required|unique:users,username',
            'email'        => 'required|email|unique:care_homes,email|unique:users,email',
            'phone'        => 'nullable|string|max:30',
            'password'     => 'required|string|min:8',
            // 'is_active'     => 'required',
        ]);

        DB::transaction(function () use ($data) {
            $careHome = CareHome::create([
                'name'         => $data['name'],
                'address'      => $data['address'],
                'manager_name' => $data['manager_name'],
                'email'        => $data['email'],
                'phone'        => $data['phone'] ?? null,
                'is_active'        => $data['is_active'] ?? 1,
            ]);

            User::create([
                'name'         => $data['manager_name'],
                'username'     => $data['username'],
                'email'        => $data['email'],
                'password'     => $data['password'],
                'role'         => 'carehome',
                'care_home_id' => $careHome->id,
            ]);
        });

        return redirect()->route('admin.care-homes.index')
            ->with('success', 'Care home and manager account created successfully.');
    }

    // ─── Edit Form ───────────────────────────────────────────────

    public function edit(CareHome $careHome)
    {
        return view('admin.care-homes.edit', compact('careHome'));
    }

    // ─── Update Care Home ────────────────────────────────────────

    public function update(Request $request, CareHome $careHome)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string',
            'manager_name' => 'required|string|max:255',
            'email'        => 'required|email|unique:care_homes,email,' . $careHome->id,
            'phone'        => 'nullable|string|max:30',
        ]);

        $careHome->update($data);

        return redirect()->route('admin.care-homes.show', $careHome)
            ->with('success', 'Care home updated successfully.');
    }

    // ─── Delete Care Home ────────────────────────────────────────

    public function destroy(CareHome $careHome)
    {
        $careHome->delete();

        return redirect()->route('admin.care-homes.index')
            ->with('success', 'Care home removed.');
    }
}
