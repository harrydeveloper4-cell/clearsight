@extends('layouts.app')
@section('page-title', 'Edit User')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.users.index') }}">Users</a>
    <span>›</span> Edit User
</div>

<div class="card" style="max-width:640px">
    <div class="card-header"><h3>✏ Edit User</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>User Name  <span style="color:var(--danger)">*</span></label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="form-group">
                <label>Email <span style="color:var(--danger)">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Role <span style="color:var(--danger)">*</span></label>
                    <select name="role" required onchange="toggleCareHome(this.value)">
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="carehome" {{ old('role', $user->role) === 'carehome' ? 'selected' : '' }}>Care Home</option>
                    </select>
                </div>
                <div class="form-group" id="care-home-field" style="display: {{ old('role', $user->role) === 'carehome' ? 'block' : 'none' }};">
                    <label>Care Home</label>
                    <select name="care_home_id">
                        <option value="">Select care home</option>
                        @foreach($careHomes as $home)
                            <option value="{{ $home->id }}" {{ old('care_home_id', $user->care_home_id) == $home->id ? 'selected' : '' }}>
                                {{ $home->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Repeat new password">
            </div>

            <div class="form-group">
                <label>Account Status</label>
                <div style="display:flex;gap:10px;align-items:center">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}> Active</label>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:6px">
                <button type="submit" class="btn btn-primary">Save User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleCareHome(role) {
        document.getElementById('care-home-field').style.display = role === 'carehome' ? 'block' : 'none';
    }
</script>

@endsection
