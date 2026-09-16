@extends('layouts.app')
@section('page-title', 'My Dashboard')

@section('content')

<div class="alert alert-info">
    🏠 Welcome back, <strong>{{ auth()->user()->careHome->name ?? '-' }}</strong>. Here is your current overview.
</div>

@if($unreadMessages > 0)
    <div class="alert alert-warn">
        💬 You have <strong>{{ $unreadMessages }}</strong> unread message(s) from ClearSight.
        <a href="{{ route('carehome.messages.index') }}" style="color:var(--navy);font-weight:700;margin-left:8px">Read Now →</a>
    </div>
@endif

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['total'] }}</div><div class="stat-label">Our Residents</div></div><div class="stat-icon blue">👥</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['due'] }}</div><div class="stat-label">Due for Eye Test</div></div><div class="stat-icon amber">🗓️</div></div>
        <div class="stat-trend warn">⚠ Schedule soon</div>
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['overdue'] }}</div><div class="stat-label">Overdue</div></div><div class="stat-icon red">🔴</div></div>
        @if($stats['overdue'] > 0)<div class="stat-trend danger">Urgent — action needed</div>@endif
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['requests'] }}</div><div class="stat-label">Total Requests</div></div><div class="stat-icon green">📋</div></div>
    </div>
</div>

<div class="grid-2" style="gap:24px">

    {{-- Overdue Residents --}}
    <div>
        <div class="section-header">
            <div>
                <div class="section-title">Overdue Residents</div>
                <div class="section-sub">Require immediate attention</div>
            </div>
            <a href="{{ route('carehome.residents.index', ['status' => 'overdue']) }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Name</th><th>Funding Status</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        @forelse($overdueResidents as $r)
                            <tr class="overdue">
                                <td><strong>{{ $r->full_name }}</strong></td>
                                <td>{{ $r->funding_status ?? '—' }}</td>
                                <td><span class="badge badge-overdue">Overdue</span></td>
                                <td><a href="{{ route('carehome.residents.show', $r) }}" class="btn btn-teal btn-xs">View →</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">
                                <div class="empty-state" style="padding:20px">
                                    <div class="icon">🎉</div>
                                    <h3>No overdue residents!</h3>
                                </div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pending Requests --}}
    <div>
        <div class="section-header">
            <div>
                <div class="section-title">Pending Requests</div>
                <div class="section-sub">Recently submitted service requests</div>
            </div>
            <a href="{{ route('carehome.requests.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Resident</th><th>Service</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($pendingRequests as $req)
                            <tr>
                                <td><strong>{{ $req->resident->full_name }}</strong></td>
                                <td>{{ $req->type_icon }} {{ $req->type }}</td>
                                <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3">
                                <div class="empty-state" style="padding:20px">
                                    <div class="icon">📋</div><h3>No pending requests</h3>
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
