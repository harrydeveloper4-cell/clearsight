@extends('layouts.auth')

@section('form')
    <h2>Welcome Back</h2>
    <p class="subtitle">Sign in to access your care portal</p>

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
    <div class="role-tabs">
        <button class="role-tab active" onclick="setRole('admin', this)">
            ClearSight Admin
        </button>
        <button class="role-tab" onclick="setRole('carehome', this)">
            Care Home
        </button>
        </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" value="{{ old('email') }}"
                   placeholder="Enter your UserName" required autofocus id="login-email">
        </div>

        <div class="form-group">
            <input type="hidden" name="role" id="role-input" value="admin">
            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Enter your password" required>
        </div>

        <!--<div style="display:flex;align-items:center;gap:8px;margin-bottom:18px">-->
        <!--    <input type="checkbox" name="remember" id="remember" style="width:auto">-->
        <!--    <label for="remember" style="font-size:13px;color:var(--gray-600);margin:0">Remember me</label>-->
        <!--    <input type="hidden" name="role" id="role-input" value="admin">    -->
        <!--</div>-->
        <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:18px">
            
            <input type="checkbox" name="terms" id="terms" required style="width:auto;margin-top:4px">
        
            <label for="terms" style="font-size:13px;color:var(--gray-600);line-height:1.6">
                I agree to the 
                
                <a href="{{ route('register') }}" target="_blank">
                    Terms & Conditions
                </a>
            </label>
        
        </div>

        <button type="submit" class="btn-submit">Sign In to Portal →</button>
    </form>
    <div class="auth-link">
        Forget Password
        <a href="{{ route('password.request.reset') }}">Reset Password</a>
    </div>
    {{-- <div class="auth-link">
        Care Home not registered yet?
        <a href="{{ route('register') }}">Create an account</a>
    </div> --}}
@endsection

@section('scripts')
<script>
    function setRole(role, element) {
        // Remove active class from all tabs
        document.querySelectorAll('.role-tab').forEach(tab => {
            document.getElementById("login-email").value =
              role === "admin"
            ? "admin@email.com"
            : "manager@carehome.com";
            tab.classList.remove('active');

            document.getElementById("role-input").value = role;
        });
        // Add active class to clicked tab
        element.classList.add('active');
        // Here you can add logic to handle the role selection
    }
</script>
@endsection