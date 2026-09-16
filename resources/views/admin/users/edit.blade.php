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

            <!--<div class="form-group">-->
            <!--    <label>Password</label>-->
            <!--    <input type="password" name="password" placeholder="Leave blank to keep current password">-->
            <!--</div>-->
            <!--<div class="form-group">-->
            <!--    <label>Confirm Password</label>-->
            <!--    <input type="password" name="password_confirmation" placeholder="Repeat new password">-->
            <!--</div>-->
            
            <div class="form-group">
                <label> Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" placeholder="Enter current password" style="padding-right:45px;">
            
                    <span class="toggle-password" data-target="password" style="position:absolute; right:15px; top:50%;transform:translateY(-50%); cursor:pointer; color:#666;">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <small style="color:var(--gray-400)">Required to change password</small>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter new password (min 8 characters)" style="padding-right:45px;">
            
                    <span class="toggle-password" data-target="password_confirmation" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#666;">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
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

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.toggle-password');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                const type = target.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';
    
                target.setAttribute('type', type);
                this.innerHTML = type === 'password'
                    ? '<i class="fa-solid fa-eye"></i>'
                    : '<i class="fa-solid fa-eye-slash"></i>';
            });
        });
    });
</script>

@endsection
