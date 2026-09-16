@extends('layouts.auth')

@section('form')
    <h2>Set New Password</h2>
    <p class="subtitle">Please enter your new password below</p>

    @if($errors->any())
        <div class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" placeholder="Enter new password" required autofocus>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
        </div>

        <button type="submit" class="btn-submit">Reset Password →</button>
    </form>

    <div class="auth-link">
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
@endsection
