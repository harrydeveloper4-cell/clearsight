@extends('layouts.app')
@section('page-title', 'My Profile')

@section('content')

<div class="card" style="max-width:640px">
    <div class="card-header"><h3>👤 My Profile</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}">
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
                <label>Email Address <span style="color:var(--danger)">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                       placeholder="+44 1253 441220">
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="3" placeholder="Your address">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-group">
                <label>Role</label>
                <input type="text" value="{{ ucfirst($user->role) }}" readonly style="background:#f5f5f5">
                <small style="color:var(--gray-400)">Contact admin to change role</small>
            </div>

            @if($user->careHome)
            <div class="form-group">
                <label>Care Home</label>
                <input type="text" value="{{ $user->careHome->name }}" readonly style="background:#f5f5f5">
                <small style="color:var(--gray-400)">Contact admin to change care home</small>
            </div>
            @endif

            <hr style="margin:20px 0;border:none;border-top:1px solid var(--gray-200)">

            <h4 style="margin-bottom:15px">Change Password</h4>

            <div class="form-group">
                <label>Current Password</label>
                <div style="position:relative;">
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           placeholder="Enter current password"
                           style="padding-right:45px;">
            
                    <span class="toggle-password"
                          data-target="current_password"
                          style="
                            position:absolute;
                            right:15px;
                            top:50%;
                            transform:translateY(-50%);
                            cursor:pointer;
                            color:#666;
                          ">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <!--<input type="password" name="current_password" placeholder="Enter current password">-->
                <small style="color:var(--gray-400)">Required to change password</small>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <div style="position:relative;">
                    <input type="password"
                           name="new_password"
                           id="new_password"
                           placeholder="Enter new password (min 8 characters)"
                           style="padding-right:45px;">
            
                    <span class="toggle-password"
                          data-target="new_password"
                          style="
                            position:absolute;
                            right:15px;
                            top:50%;
                            transform:translateY(-50%);
                            cursor:pointer;
                            color:#666;
                          ">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <!--<input type="password" name="new_password" placeholder="Enter new password (min 8 characters)">-->
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <div style="position:relative;">
                    <input type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation"
                           placeholder="Repeat new password"
                           style="padding-right:45px;">
            
                    <span class="toggle-password"
                          data-target="new_password_confirmation"
                          style="
                            position:absolute;
                            right:15px;
                            top:50%;
                            transform:translateY(-50%);
                            cursor:pointer;
                            color:#666;
                          ">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <!--<input type="password" name="new_password_confirmation" placeholder="Repeat new password">-->
            </div>

            <div style="display:flex;gap:10px;margin-top:20px">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

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