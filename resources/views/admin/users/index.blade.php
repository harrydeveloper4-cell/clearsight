@extends('layouts.app')
@section('page-title', 'Users')

@section('content')

<div class="section-header">
    <div>
        <div class="section-title">User Management</div>
        <div class="section-sub">View and manage all user accounts.</div>
    </div>
    @if(auth()->user()->is_admin == 1)
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Add User</a>
    @endif
</div>

<form method="GET" class="filter-row">
    <input class="filter-input" type="text" name="search"
           value="{{ request('search') }}" placeholder="🔍 Search by name or email...">
    <button type="submit" class="btn btn-teal btn-sm">Search</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Care Home</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    @if($user->is_admin == 1 && auth()->user()->is_admin == 0)
                        @continue
                    @endif
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->careHome?->name ?? '—' }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge badge-ok">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline btn-xs">Edit</a>
                            @if(auth()->user()->is_admin == 1)
                            <form method="POST" action="{{ route('admin.users.deleteUser', $user) }}"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <div class="icon">👤</div>
                            <h3>No users found</h3>
                            <p>Try another search term or check your filters.</p>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">{{ $users->links() }}</div>

@endsection
