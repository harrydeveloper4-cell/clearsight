@extends('layouts.app')
@section('page-title', 'Edit Care Home')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.care-homes.index') }}">Care Homes</a>
    <span>›</span>
    <a href="{{ route('admin.care-homes.show', $careHome) }}">{{ $careHome->name }}</a>
    <span>›</span> Edit
</div>

<div class="card" style="max-width:640px">
    <div class="card-header"><h3>✏️ Edit — {{ $careHome->name }}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.care-homes.update', $careHome) }}">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Care Home Name</label>
                <input type="text" name="name" value="{{ old('name', $careHome->name) }}" required>
            </div>
            <div class="form-group">
                <label>Full Address</label>
                <input type="text" name="address" value="{{ old('address', $careHome->address) }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Manager Name</label>
                    <input type="text" name="manager_name" value="{{ old('manager_name', $careHome->manager_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', $careHome->phone) }}">
                </div>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email', $careHome->email) }}" required>
            </div>
            
            <div class="form-group">
                <label>Account Status</label>
                <div style="display:flex;gap:10px;align-items:center">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $careHome->is_active) ? 'checked' : '' }}> Active</label>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:6px">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.care-homes.show', $careHome) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
