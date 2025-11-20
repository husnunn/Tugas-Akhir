<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SDGs Desa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage Data
    </div>

    <li class="nav-item {{ request()->is('desa') ? 'active' : '' }}">
        <a class="nav-link" href="/desa">
            <i class="fas fa-home"></i>
            <span>Desa</span></a>
    </li>

    {{-- <li class="nav-item {{ request()->is('data-rt') ? 'active' : '' }}">
        <a class="nav-link" href="/data-rt">
            <i class="fas fa-users"></i>
            <span>Rukun Tetangga (RT)</span></a>
    </li>

    <li class="nav-item {{ request()->is('kg-p2.index') ? 'active' : '' }}">
        <a class="nav-link" href="/kg-p2">
            <i class="fas fa-house-user"></i>
            <span>Keluarga</span></a>
    </li>

    <li class="nav-item {{ request()->is('idv-p1.index') ? 'active' : '' }}">
        <a class="nav-link" href="/idv-p1">
            <i class="fas fa-user"></i>
            <span>Individu</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Manage User
    </div>

    <li class="nav-item {{ request()->is('userweb') ? 'active' : '' }}">
        <a class="nav-link" href="/userweb">
            <i class="fas fa-user-cog"></i>
            <span>User</span></a>
    </li>

    <li class="nav-item {{ request()->is('jabatan') ? 'active' : '' }}">
        <a class="nav-link" href="/jabatan">
            <i class="fas fa-briefcase"></i>
            <span>Jabatan</span></a>
    </li>

    <li class="nav-item {{ request()->is('survey') ? 'active' : '' }}">
        <a class="nav-link" href="/survey">
            <i class="fas fa-poll"></i>
            <span>Survey</span></a>
    </li>

    <li class="nav-item {{ request()->is('lembaga') ? 'active' : '' }}">
        <a class="nav-link" href="/lembaga">
            <i class="fas fa-building"></i>
            <span>Master Lembaga</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
