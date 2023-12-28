<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{asset('../assets/images/faces/face8.jpg')}}" alt="profile image">
                    {{-- <div class="dot-indicator bg-success"></div> --}}
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ $auth->name }}</p>
                    <p class="designation">{{ ($auth->level) ? $auth->level : 'Member' }}</p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ ($auth->level) ? '/admin/dashboard' : '/member/dashboard' }}">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        @if($auth->level == 'Admin' || $auth->level == 'Kasir')
        <li class="nav-item nav-category"><span class="nav-link">KELOLA DATA</span></li>
        @endif
        @if($auth->level == 'Admin')
        <li class="nav-item">
            <a class="nav-link" href="/admin/user">
                <span class="menu-title">Kelola Data User</span>
                <i class="icon-layers menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/member">
                <span class="menu-title">Kelola Data Member</span>
                <i class="icon-user menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/supplier">
                <span class="menu-title">Kelola Data Supplier</span>
                <i class="icon-briefcase menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/sepatu">
                <span class="menu-title">Kelola Data Sepatu</span>
                <i class="icon-rocket menu-icon"></i>
            </a>
        </li>
        @endif
        @if($auth->level == 'Admin' || $auth->level == 'Kasir')
        <li class="nav-item">
            <a class="nav-link" href="/admin/penjualan">
                <span class="menu-title">Kelola Data Penjualan</span>
                <i class="icon-grid menu-icon"></i>
            </a>
        </li>
        @endif
        <li class="nav-item nav-category"><span class="nav-link">Lainnya</span></li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Lainnya</span>
                <i class="icon-settings menu-icon"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ ($auth->level) ? '/admin/profile' : '/member/profile' }}"> Profile </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ ($auth->level) ? '/admin/logout' : '/member/logout' }}"> Logout </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>