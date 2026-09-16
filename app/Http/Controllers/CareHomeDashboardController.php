<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\ServiceRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CareHomeDashboardController extends Controller
{
    public function index()
    {
        $careHomeId = Auth::user()->care_home_id;

        $residents = Resident::where('care_home_id', $careHomeId)
            ->where('is_active', true)
            ->get();

        $stats = [
            'total'    => $residents->count(),
            'due'      => $residents->where('status', 'due')->count(),
            'overdue'  => $residents->where('status', 'overdue')->count(),
            'requests' => ServiceRequest::where('care_home_id', $careHomeId)->count(),
        ];

        $overdueResidents = $residents->where('status', 'overdue')->take(5);

        $pendingRequests = ServiceRequest::with('resident')
            ->where('care_home_id', $careHomeId)
            ->whereIn('status', ['New', 'In Progress'])
            ->latest()
            ->take(5)
            ->get();

        $unreadMessages = Message::where('care_home_id', $careHomeId)
            ->where('is_read', false)
            ->where('sender_id', '!=', Auth::id())
            ->count();

        return view('carehome.dashboard', compact(
            'stats',
            'overdueResidents',
            'pendingRequests',
            'unreadMessages'
        ));
    }
}
