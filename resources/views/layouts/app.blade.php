<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ClearSight Care Portal')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @yield('style')
</head>
<body>
    
   

{{-- ── Sidebar ── --}}

<nav class="sidebar sidebars">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">👁️</div>
        <div class="brand-text">
            <div class="name">ClearSight</div>
            <div class="tag">Care Portal</div>
        </div>
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div class="role-badge">{{ strtoupper(auth()->user()->role) }}</div>
            <div class="uname">{{ auth()->user()->name }}</div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
        <div class="nav-section-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="nav-icon">💬</span> Messages
            @php $unread = \App\Models\Message::where('sender_id','!=',auth()->id())->where('is_read',false)->count(); @endphp
            @if($unread > 0)<span class="nav-badge">{{ $unread }}</span>@endif
        </a>
        <a href="{{ route('admin.care-homes.index') }}" class="nav-item {{ request()->routeIs('admin.care-homes.*') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span> Care Homes
        </a>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> Users
        </a>
        <div class="nav-section-label">Residents</div>
        <a href="{{ route('admin.residents.index') }}" class="nav-item {{ request()->routeIs('admin.residents.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> All Residents
        </a>
        <div class="nav-section-label">Operations</div>
        <a href="{{ route('admin.requests.index') }}" class="nav-item {{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span> Service Requests
            @php $newCount = \App\Models\ServiceRequest::where('status','New')->count(); @endphp
            @if($newCount > 0)<span class="nav-badge">{{ $newCount }}</span>@endif
        </a>
        <a href="{{ route('admin.activity-logs') }}" class="nav-item {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}">
            <span class="nav-icon">📝</span> Activity Logs
        </a>
        
        <div class="nav-section-label">Account</div>
        <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="nav-icon">👤</span> My Profile
        </a>
    @else
        <div class="nav-section-label">Overview</div>
        <a href="{{ route('carehome.dashboard') }}" class="nav-item {{ request()->routeIs('carehome.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span> My Dashboard
        </a>
        <a href="{{ route('carehome.messages.index') }}" class="nav-item {{ request()->routeIs('carehome.messages.*') ? 'active' : '' }}">
            <span class="nav-icon">💬</span> Messages
            @php $myUnread = \App\Models\Message::where('care_home_id',auth()->user()->care_home_id)->where('sender_id','!=',auth()->id())->where('is_read',false)->count(); @endphp
            @if($myUnread > 0)<span class="nav-badge">{{ $myUnread }}</span>@endif
        </a>
        @if(auth()->user()->careHome)
        <div class="nav-section-label">Residents</div>
        <a href="{{ route('carehome.residents.index') }}" class="nav-item {{ request()->routeIs('carehome.residents.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> Our Residents
        </a>
        <div class="nav-section-label">Services</div>
        <a href="{{ route('carehome.requests.index') }}" class="nav-item {{ request()->routeIs('carehome.requests.*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span> Service Requests
            @php $myNew = \App\Models\ServiceRequest::where('care_home_id',auth()->user()->care_home_id)->where('status','New')->count(); @endphp
            @if($myNew > 0)<span class="nav-badge">{{ $myNew }}</span>@endif
        </a>
        @endif
       
        <div class="nav-section-label">Account</div>
        <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="nav-icon">👤</span> My Profile
        </a>
    @endif

    <div class="nav-section-label">Legal</div>
    <!-- Portal_policy_.pdf -->
    <a href="{{ route('privacy-policy') }}" class="nav-item {{ request()->routeIs('privacy-policy') ? 'active' : '' }}">
        <span class="nav-icon">🔒</span> Privacy Policy
    </a>
    <!-- Portal_instruction_.pdf -->
    <a href="{{ route('terms-of-use') }}" class="nav-item {{ request()->routeIs('terms-of-use') ? 'active' : '' }}">
        <span class="nav-icon">📄</span> Terms of Use
    </a>

    <a href="{{ asset('files/ico-certificate..pdf') }}" target="_blank" class="nav-item">
        <span class="nav-icon">📄</span> ICO Certified
        
    </a>

    <!-- <div class="sidebar-contact">
        <div class="contact-title">Company Details</div>
        <div class="contact-info">📞 0333 3355350</div>
        <div class="contact-info">📧 Info@clearsightdomiciliary.com</div>
        <div class="contact-info">🌐 <a href="https://clearsightdomiciliary.com/" target="_blank">Clearsight Domiciliary  | Home & Carehome Eyecare | 7 Days A Week | Book Now</a></div>
    </div> -->

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">⬅ Sign Out</button>
        </form>
    </div>
</nav>

{{-- ── Main Content ── --}}
<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-date">{{ now()->format('D, d M Y') }}</div>
        <button class="pullbtns">☰</button> 
    </div>

    <div class="content">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">❌ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style:none">
                    @foreach($errors->all() as $error)
                        <li>❌ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script>
const pullBtns = document.querySelector('.pullbtns');
const sidebars = document.querySelector('.sidebar');

pullBtns.addEventListener('click', () => {
    sidebars.classList.toggle('activemenu');
});
</script>

@yield('script')
</body>
</html>
