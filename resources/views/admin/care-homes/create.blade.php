@extends('layouts.app')
@section('page-title', 'Add Care Home')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.care-homes.index') }}">Care Homes</a>
    <span>›</span> Add New
</div>

<div class="card" style="max-width:640px">
    <div class="card-header"><h3>🏠 Add New Care Home</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.care-homes.store') }}">
            @csrf

            <div class="form-group">
                <label>Care Home Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="e.g. Amberley Care Home" required>
            </div>

            <div class="form-group">
                <label>Full Address <span style="color:var(--danger)">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}"
                       placeholder="e.g. 23 Oak Lane, Blackpool, FY1 2AB" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Manager Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="manager_name" value="{{ old('manager_name') }}"
                           placeholder="e.g. Sarah Collins" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           placeholder="+44 1253 441220">
                </div>
            </div>
            <div class="form-group">
                <label>Create Account for Care Home Manager  <span style="color:var(--danger)">*</span></label>
            </div>
            <div class="form-group">
                <label>User Name  <span style="color:var(--danger)">*</span></label>
                <input type="text" name="username" value="{{ old('username') }}"
                placeholder="managercarehome" required>
            </div>
            <div class="form-group">
                <label>Email Address  <span style="color:var(--danger)">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                placeholder="manager@carehome.co.uk" required>
            </div>
            <div class="form-group">
                <label>Password <span style="color:var(--danger)">*</span></label>
                <input type="password" name="password" value="{{ old('password') }}"
                placeholder="Enter a strong password" required>
            </div>

            <div style="display:flex;gap:10px;margin-top:6px">
                <button type="submit" class="btn btn-primary">Save Care Home</button>
                <a href="{{ route('admin.care-homes.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
