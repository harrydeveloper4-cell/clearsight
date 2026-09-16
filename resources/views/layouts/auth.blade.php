<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'ClearSight Care Portal')</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="auth-left">
    <div class="brand">
        <div class="brand-icon">👁️</div>
        <div class="brand-name">ClearSight Domiciliary</div>
    </div>
    <h1>Care Portal<br>System</h1>
    <p>A secure, centralised platform for managing eye care and hearing care services across all your care homes.</p>
    <div class="features">
        <div class="feature"><div class="feature-icon">🏠</div><span>Manage care homes & residents</span></div>
        <div class="feature"><div class="feature-icon">📋</div><span>Track recalls & submit service requests</span></div>
        <div class="feature"><div class="feature-icon">🔒</div><span>GDPR-compliant & fully encrypted</span></div>
    </div>
    <div class="features">
        <div class="feature">
            <a class="ico-link" href="{{ asset('files/ico-certificate..pdf') }}" target="_blank"><img class="brand-icon" src="{{ asset('images/ico-certificate-02.png') }}" alt="Feature 1"></a><a class="ico-link" href="{{ asset('files/ico-certificate..pdf') }}" target="_blank">ICO Certified</a>
        </div>
    </div>
    <div class="auth-contact">
        <div class="contact-item"><h2>Company Details</h2></div>
        <div class="contact-item"><span class="footer-info">📞 Tell: </span> 0333 3355350</div>
        <div class="contact-item"><span class="footer-info">📧 Email: </span> Info@clearsightdomiciliary.com</div>
        <div class="contact-item"><span class="footer-info">🌐 Web: </span><a href="https://clearsightdomiciliary.com/" target="_blank">Clearsight Domiciliary  | Home & Carehome Eyecare | 7 Days A Week | Book Now</a></div>
    </div>
    
</div>
<div class="auth-right">
    <div class="auth-card">
        @yield('form')
    </div>
</div>

<div id="cookie-banner" style="position: fixed; bottom: 20px; left: 20px; right: 20px; background: #222; color: #fff; padding: 15px; border-radius: 10px; display: none; z-index: 9999;">
    This website uses cookies to improve your experience.

    <button onclick="acceptCookies()" style="margin-left:10px; padding:8px 15px; background: green; color:white; border:none; cursor:pointer;">
        Accept
    </button>
</div>

<script>
    function acceptCookies() {
        localStorage.setItem('cookiesAccepted', 'yes');
        document.getElementById('cookie-banner').style.display = 'none';
    }
    
    window.onload = function () {
        if (!localStorage.getItem('cookiesAccepted')) {
            document.getElementById('cookie-banner').style.display = 'block';
        }
    }
</script>

@yield('scripts')
</body>
</html>
