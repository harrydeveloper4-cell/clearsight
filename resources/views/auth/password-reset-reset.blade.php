@extends('layouts.auth')

@section('form')
    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="success-message" style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    

    <form method="POST" action="{{ route('password.reset') }}">
        @csrf

        <div class="form-group">
            <label>Enter your Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="Enter your email" required autofocus id="login-email">
        </div>

        <button type="submit" class="btn-submit">Reset Password</button>
    </form>
    <div class="auth-link">

        <a href="{{ route('login') }}">Back</a>
    </div>

@endsection
