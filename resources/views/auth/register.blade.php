@extends('layouts.auth')

@section('form')
    <h2>Register Care Home</h2>
    <p class="subtitle">Create your account to access the portal</p>

    @if($errors->any())
        <div class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Your Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   placeholder="e.g. Sarah Collins" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="manager@carehome.co.uk" required>
        </div>

        <div class="form-group">
            <label>Select Your Care Home</label>
            <select name="care_home_id" required>
                <option value="">— Choose care home —</option>
                @foreach($careHomes as $home)
                    <option value="{{ $home->id }}" {{ old('care_home_id') == $home->id ? 'selected' : '' }}>
                        {{ $home->name }}
                    </option>
                @endforeach
            </select>
            <div style="font-size:12px;color:var(--gray-400);margin-top:5px">
                If your care home is not listed, please contact ClearSight.
            </div>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Minimum 8 characters" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation"
                   placeholder="Re-enter your password" required>
        </div>

        <button type="submit" class="btn-submit">Create Account →</button>
    </form>

    <div class="auth-link">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
@endsection
