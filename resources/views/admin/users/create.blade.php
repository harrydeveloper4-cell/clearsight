@extends('layouts.app')
@section('page-title', 'Add Care Home')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.users.index') }}">Users</a>
    <span>›</span> Add New
</div>

<div class="card" style="max-width:640px">
    <div class="card-header"><h3>🏠 Add New User</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label>Full Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="e.g. Amberley User" required>
            </div>
            <div class="form-group">
                <label>Full Address <span style="color:var(--danger)">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}"
                        placeholder="e.g. 23 Oak Lane, Blackpool, FY1 2AB" required>
            </div>
            <div class="form-group">
                <label>Phone Number<span style="color:var(--danger)">*</span></label>
                <input type="tel" name="phone" value="{{ old('phone') }}"
                        placeholder="+44 1253 441220">
            </div>
            <div class="form-group">
                <label>User Name  <span style="color:var(--danger)">*</span></label>
                <input type="text" name="username" value="{{ old('username') }}"
                placeholder="managercarehome" required>
            </div>
            <div class="form-group">
                <label>Email Address  <span style="color:var(--danger)">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                placeholder="user@carehome.co.uk" required>
            </div>
            <div class="form-group">
                <label>Password <span style="color:var(--danger)">*</span></label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Enter a strong password" required style="padding-right:45px;">
            
                    <span id="togglePassword" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#666;">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <!--<input type="password" name="password" value="{{ old('password') }}" placeholder="Enter a strong password" required>-->
            </div>
            {{--
            <div class="form-group">
                <label>Role </label>
                <select name="Role" class="form-control select-role">
                    <option value="admin">Admin</option>
                    <option value="carehome">Care Home</option>
                </select>
            </div>
            <div class="form-group d-none">
                <label>Role </label>
                <select name="Role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="carehome">Care Home</option>
                </select>
            </div>
            --}}

            <div style="display:flex;gap:10px;margin-top:6px">
                <button type="submit" class="btn btn-primary">Save User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
@section('style')
<style>
    /* .d-none{
        display:none;
    } */
</style>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
@endsection
@section('script')


<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {

        const type = password.getAttribute('type') === 'password'
            ? 'text'
            : 'password';

        password.setAttribute('type', type);

        this.innerHTML = type === 'password'
            ? '<i class="fa-solid fa-eye"></i>'
            : '<i class="fa-solid fa-eye-slash"></i>';
    });

});
// $(document).ready(function () {

//     $('.select-role').on('change', function () {
//         let role = $(this).val();
//         if (role == 'admin') {
//             $('.d-none').hide();
//         }
//         if (role == 'carehome') {
//             $('.d-none').show();
//         }
//     });

// });
</script>
@endsection