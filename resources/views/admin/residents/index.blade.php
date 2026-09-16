@extends('layouts.app')
@section('page-title', 'All Residents')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">Resident Management</div>
        <div class="section-sub">All active residents across all care homes</div>
    </div>
    <a href="{{ route('admin.residents.create') }}" class="btn btn-primary">+ Add Resident</a>
</div>

{{-- Filters --}}
<form method="GET" class="filter-row">
    <input class="filter-input" type="text" name="search"
           value="{{ request('search') }}" placeholder="🔍 Search by name...">
    <select class="filter-select" name="status">
        <option value="">All Status</option>
        <option value="ok"      {{ request('status') === 'ok'      ? 'selected' : '' }}>Up to Date</option>
        <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
    </select>
    <select class="filter-select" name="care_home_id">
        <option value="">All Homes</option>
        @foreach($careHomes as $home)
            <option value="{{ $home->id }}" {{ request('care_home_id') == $home->id ? 'selected' : '' }}>
                {{ $home->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-teal btn-sm">Filter</button>
    <a href="{{ route('admin.residents.index') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card">
    <div class="table-wrap resident-tbl">
        <table>
            <thead>
                <tr>
                    <th>Resident</th><th>DOB</th><th>Care Home</th><th>Funding Status</th>
                    <th>Last Eye Test</th><th>Next Recall</th><th>Status</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($residents as $r)
                    <tr class="{{ $r->status === 'overdue' ? 'overdue' : '' }}">
                        <td>
                            <div style="font-weight:600">{{ $r->full_name }}</div>
                            <div style="font-size:12px;color:var(--gray-400)">{{ $r->age }} yrs</div>
                        </td>
                        <td>{{ $r->dob ?? '—' }}</td>
                        <td>{{ $r->careHome->name }}</td>
                        <td>{{ $r->funding_status ?? '—' }}</td>
                        <td>{{ $r->last_eye_test?->format('d M Y') ?? '—' }}</td>
                        <td>{{ $r->next_recall_date?->format('d M Y') ?? '—' }}</td>
                        <td>
                            @if($r->status === 'overdue')
                                <span class="badge badge-overdue">Overdue</span>
                            @elseif($r->status === 'due')
                                <span class="badge badge-due">Due</span>
                            @else
                                <span class="badge badge-ok">Up to Date</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.residents.show', $r) }}" class="btn btn-outline btn-xs">View →</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <div class="icon">👥</div>
                            <h3>No residents found</h3>
                            <p>Try adjusting your search filters.</p>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="pagination">{{ $residents->links() }}</div>

@endsection
