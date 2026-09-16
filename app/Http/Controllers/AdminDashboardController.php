<?php

namespace App\Http\Controllers;

use App\Models\CareHome;
use App\Models\Resident;
use App\Models\ServiceRequest;
use App\Models\Message;
use Spatie\Activitylog\Models\Activity;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_homes'     => CareHome::count(),
            'total_residents' => Resident::where('is_active', true)->count(),
            'due'             => Resident::where('is_active', true)->where('status', 'due')->count(),
            'overdue'         => Resident::where('is_active', true)->where('status', 'overdue')->count(),
            'new_requests'    => ServiceRequest::where('status', 'New')->count(),
            'in_progress'     => ServiceRequest::where('status', 'In Progress')->count(),
        ];

        $careHomes = CareHome::withCount([
            'activeResidents',
            'activeResidents as due_count'      => fn($q) => $q->where('status', 'due'),
            'activeResidents as overdue_count'  => fn($q) => $q->where('status', 'overdue'),
        ])->get();

        $recentRequests = ServiceRequest::with(['resident', 'careHome'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'careHomes', 'recentRequests'));
    }

    public function activityLogs()
    {
        $activities = Activity::with('causer')
            ->latest()
            ->paginate(20);

        return view('admin.activity-logs', compact('activities'));
    }
}
