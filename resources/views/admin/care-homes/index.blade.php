@extends('layouts.app')
@section('page-title', 'Care Homes')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">All Care Homes</div>
        <div class="section-sub">Manage all registered care home accounts</div>
    </div>
    <a href="{{ route('admin.care-homes.create') }}" class="btn btn-primary">+ Add Care Home</a>
</div>

<div class="ch-grid">
    @forelse($careHomes as $home)
        <a href="{{ route('admin.care-homes.show', $home) }}" class="ch-card">
            <h3>{{ $home->name }}</h3>
            <div class="addr">📍 {{ $home->address }}</div>
            <div style="font-size:12px;color:var(--gray-400);margin-bottom:14px">
                👤 {{ $home->manager_name }} &nbsp;|&nbsp; ✉ {{ $home->email }}
            </div>
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
    @empty
        <div class="empty-state" style="grid-column:1/-1">
            <div class="icon">🏠</div>
            <h3>No care homes yet</h3>
            <p>Add your first care home to get started.</p>
            <a href="{{ route('admin.care-homes.create') }}" class="btn btn-primary" style="margin-top:14px">+ Add Care Home</a>
        </div>
    @endforelse
</div>

@endsection
