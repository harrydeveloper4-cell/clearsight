<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function exportResidents()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $filename = 'residents_' . now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, ['ID', 'First Name', 'Last Name', 'DOB', 'Age', 'Funding Status', 'Status', 'Care Home', 'Created At', 'Updated At']);
            
            // Fetch residents
            $residents = Resident::with('careHome')->get();
            
            foreach ($residents as $resident) {
                fputcsv($file, [
                    $resident->id,
                    $resident->first_name,
                    $resident->last_name,
                    $resident->dob ? $resident->dob->format('Y-m-d') : '',
                    $resident->age,
                    $resident->funding_status,
                    $resident->status,
                    $resident->careHome?->name,
                    $resident->created_at->format('Y-m-d H:i:s'),
                    $resident->updated_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportUsers()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $filename = 'users_' . now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Username', 'Phone', 'Role', 'Care Home', 'Is Active', 'Created At']);
            
            // Fetch users
            $users = User::with('careHome')->get();
            
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->username,
                    $user->phone,
                    $user->role,
                    $user->careHome?->name,
                    $user->is_active ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
