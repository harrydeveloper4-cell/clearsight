@extends('layouts.app')
@section('page-title', 'Service Requests')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Our Service Requests</div>
        <div class="section-sub">Track all requests submitted for {{ auth()->user()->careHome->name ?? '-' }}</div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" class="filter-row">
    <select class="filter-select" name="type">
        <option value="">All Services</option>
        @foreach(['Eye Test','Replacement Glasses','Ear Wax Removal','Hearing Care'] as $type)
            <option {{ request('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
    <select class="filter-select" name="status">
        <option value="">All Statuses</option>
        @foreach(['New','In Progress','Completed'] as $s)
            <option {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-teal btn-sm">Filter</button>
    <a href="{{ route('carehome.requests.index') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

{{-- Status Summary Badges --}}
<div style="display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap">
    @php
        $newCount  = $requests->where('status','New')->count();
        $inProg    = $requests->where('status','In Progress')->count();
        $done      = $requests->where('status','Completed')->count();
    @endphp
    <div style="padding:8px 16px;background:white;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px">
        🔵 <strong>{{ $newCount }}</strong> New
    </div>
    <div style="padding:8px 16px;background:white;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px">
        🟡 <strong>{{ $inProg }}</strong> In Progress
    </div>
    <div style="padding:8px 16px;background:white;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px">
        🟢 <strong>{{ $done }}</strong> Completed
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Resident</th><th>Service</th><th>Priority</th>
                    <th>Date Submitted</th><th>Status</th><th>Notes</th><th>Reports</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>
                            <div style="font-weight:600">{{ $req->resident->full_name }}</div>
                            <div style="font-size:12px;color:var(--gray-400)">{{ $req->resident->funding_status }}</div>
                        </td>
                        <td>{{ $req->type_icon }} {{ $req->type }}</td>
                        <td>
                            <span class="badge {{ $req->priority === 'Urgent' ? 'badge-overdue' : 'badge-new' }}">
                                {{ $req->priority }}
                            </span>
                        </td>
                        <td>{{ $req->created_at->format('d M Y, H:i') }}</td>
                        <td><span class="badge {{ $req->status_badge }}">{{ $req->status }}</span></td>
                        <td style="font-size:13px;color:var(--gray-600)">{{ $req->notes ?: '—' }}</td>
                        <td>
                           
                            @if($req->reports_count > 0)
                                <a href="{{ route('carehome.requests.reports', $req) }}" class="btn btn-outline btn-sm" style="margin-left:8px; display:inline-block;">
                                    View ({{ $req->reports_count }})
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <div class="icon">📋</div>
                            <h3>No requests submitted yet</h3>
                            <p>Go to a resident's profile to submit a service request.</p>
                            <a href="{{ route('carehome.residents.index') }}"
                               class="btn btn-primary" style="margin-top:14px">
                                Go to Residents →
                            </a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">{{ $requests->links() }}</div>

@endsection
