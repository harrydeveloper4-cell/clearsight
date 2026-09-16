@extends('layouts.app')
@section('page-title', 'Admin Dashboard')

@section('content')

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-top">
            <div><div class="stat-val">{{ $stats['total_homes'] }}</div><div class="stat-label">Care Homes</div></div>
            <div class="stat-icon blue">🏠</div>
        </div>
        <div class="stat-trend up">↑ All Active</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div><div class="stat-val">{{ $stats['total_residents'] }}</div><div class="stat-label">Total Residents</div></div>
            <div class="stat-icon teal">👥</div>
        </div>
        <div class="stat-trend up">↑ Active records</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div><div class="stat-val">{{ $stats['due'] }}</div><div class="stat-label">Due for Recall</div></div>
            <div class="stat-icon amber">🗓️</div>
        </div>
        <div class="stat-trend warn">⚠ Schedule soon</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div><div class="stat-val">{{ $stats['overdue'] }}</div><div class="stat-label">Overdue</div></div>
            <div class="stat-icon red">🔴</div>
        </div>
        <div class="stat-trend danger">↑ Urgent attention</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div><div class="stat-val">{{ $stats['new_requests'] }}</div><div class="stat-label">New Requests</div></div>
            <div class="stat-icon green">📋</div>
        </div>
        <div class="stat-trend up">{{ $stats['in_progress'] }} in progress</div>
    </div>
</div>

<div class="grid-2" style="gap:24px">

    {{-- Care Homes Overview --}}
    <div>
        <div class="section-header">
            <div>
                <div class="section-title">Care Homes</div>
                <div class="section-sub">All registered care home accounts</div>
            </div>
            <a href="{{ route('admin.care-homes.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <div class="ch-grid" style="grid-template-columns:1fr">
            @foreach($careHomes as $home)
                <a href="{{ route('admin.care-homes.show', $home) }}" class="ch-card">
                    <h3>{{ $home->name }}</h3>
                    <div class="addr">📍 {{ $home->address }}</div>
                    <div class="ch-stats">
                        <div class="ch-stat">
                            <div class="num">{{ $home->active_residents_count }}</div>
                            <div class="lbl">Residents</div>
                        </div>
                        <div class="ch-stat warn">
                            <div class="num">{{ $home->due_count }}</div>
                            <div class="lbl">Due</div>
                        </div>
                        <div class="ch-stat danger">
                            <div class="num">{{ $home->overdue_count }}</div>
                            <div class="lbl">Overdue</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Recent Requests --}}
    <div>
        <div class="section-header">
            <div>
                <div class="section-title">Recent Requests</div>
                <div class="section-sub">Latest service requests across all homes</div>
            </div>
            <a href="{{ route('admin.requests.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <div class="card">
            <div class="table-wrap db-table">
                <table>
                    <thead>
                        <tr><th>Resident</th><th>Service</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $req)
                            <tr>
                                <td>
                                    <div style="font-weight:600">{{ $req->resident->full_name }}</div>
                                    <div style="font-size:12px;color:var(--gray-400)">{{ $req->careHome->name }}</div>
                                </td>
                                <td>{{ $req->type_icon }} {{ $req->type }}</td>
                                <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3">
                                <div class="empty-state" style="padding:24px">
                                    <div class="icon">📋</div>
                                    <h3>No requests yet</h3>
                                </div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
