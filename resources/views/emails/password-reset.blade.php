<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('password/request/new/' . $token) }}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>
