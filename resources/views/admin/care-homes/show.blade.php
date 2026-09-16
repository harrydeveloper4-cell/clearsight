@extends('layouts.app')
@section('page-title', $careHome->name)

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.care-homes.index') }}">Care Homes</a>
    <span>›</span> {{ $careHome->name }}
</div>

{{-- Header Card --}}
<div class="card" style="margin-bottom:20px">
    <div class="profile-header">
        <div class="profile-avatar">🏠</div>
        <div style="flex:1">
            <div class="profile-info">
                <h2>{{ $careHome->name }}</h2>
            </div>
            <div class="profile-meta">
                <span>📍 {{ $careHome->address }}</span>
                <span>👤 {{ $careHome->manager_name }}</span>
                <span>✉ {{ $careHome->email }}</span>
                <span>📞 {{ $careHome->phone ?? 'N/A' }}</span>
            </div>
        </div>
        <div style="display:flex;gap:8px">
            <a href="{{ route('admin.care-homes.edit', $careHome) }}" class="btn btn-outline btn-sm">✏ Edit</a>
            <form method="POST" action="{{ route('admin.care-homes.destroy', $careHome) }}"
                  onsubmit="return confirm('Delete this care home? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑 Delete</button>
            </form>
        </div>
    </div>
</div>

{{-- Stats --}}
<div class="grid-4" style="margin-bottom:24px">
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['total'] }}</div><div class="stat-label">Residents</div></div><div class="stat-icon blue">👥</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['due'] }}</div><div class="stat-label">Due</div></div><div class="stat-icon amber">🗓️</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $stats['overdue'] }}</div><div class="stat-label">Overdue</div></div><div class="stat-icon red">🔴</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-top"><div><div class="stat-val">{{ $requests->count() }}</div><div class="stat-label">Requests</div></div><div class="stat-icon green">📋</div></div>
    </div>
</div>

{{-- Residents Table --}}
<div class="section-header">
    <div class="section-title">Residents</div>
    <a href="{{ route('admin.residents.create', $careHome->id) }}" class="btn btn-primary btn-sm">+ Add Resident</a>
</div>

<div class="card" style="margin-bottom:24px">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Name</th><th>Funding Status</th><th>Last Eye Test</th><th>Next Recall</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($residents as $r)
                    <tr class="{{ $r->status === 'overdue' ? 'overdue' : '' }}">
                        <td><strong>{{ $r->full_name }}</strong></td>
                        <td>{{ $r->funding_status ?? '—' }}</td>
                        <td>{{ $r->last_eye_test?->format('d M Y') ?? '—' }}</td>
                        <td>{{ $r->next_recall_date?->format('d M Y') ?? '—' }}</td>
                        <td>
                            <span class="badge badge-{{ $r->status }}">
                                {{ ucfirst($r->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.residents.show', $r) }}" class="btn btn-outline btn-xs">View →</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">
                        <div class="empty-state" style="padding:24px">
                            <div class="icon">👥</div><h3>No residents added yet</h3>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Recent Requests --}}
<div class="section-header">
    <div class="section-title">Recent Requests</div>
    <a href="{{ route('admin.requests.index', ['care_home_id' => $careHome->id]) }}" class="btn btn-outline btn-sm">View All</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Resident</th><th>Service</th><th>Date</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>{{ $req->resident->full_name }}</td>
                        <td>{{ $req->type_icon }} {{ $req->type }}</td>
                        <td>{{ $req->created_at->format('d M Y') }}</td>
                        <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--gray-400);padding:20px">No requests yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
