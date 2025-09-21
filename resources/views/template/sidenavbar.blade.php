<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPEKA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Referensi
    </div>

    @if (session('akseslevel') == 'Operator Kabupaten')

    <li class="nav-item">
        <a class="nav-link {{ $menu == 'pengguna' ? 'active' : '' }}" href="{{ url('pengguna/ubahpassword') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Profil Saya</span></a>
    </li>
    @endif

    @if (session('akseslevel') == 'Admin')

    <li class="nav-item">
        <a class="nav-link {{ $menu == 'pengguna' ? 'active' : '' }}" href="{{ url('pengguna') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Operator</span></a>
    </li>

    @endif


    @php
    $active = '';
    $menuopen = '';
    if (in_array($menu, ['kabupaten', 'kecamatan', 'kelurahan'])) {
    $isactive = true;
    }else{
    $isactive = false;
    }
    @endphp


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!$isactive) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="@if ($isactive) false @else true @endif" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Lokasi</span>
        </a>
        <div id="collapseTwo" class="collapse @if ($isactive) show @endif" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (session('akseslevel') == 'Admin')

                <a class="collapse-item {{ $menu == 'kabupaten' ? 'active' : '' }}"
                    href="{{ url('kabupaten') }}">Kabupaten</a>

                @endif

                <a class="collapse-item {{ $menu == 'kecamatan' ? 'active' : '' }}"
                    href="{{ url('kecamatan') }}">Kecamatan</a>
                <a class="collapse-item {{ $menu == 'kelurahan' ? 'active' : '' }}"
                    href="{{ url('kelurahan') }}">Kelurahan/ Desa</a>
            </div>
        </div>
    </li>

    @if (session('akseslevel') == 'Admin')

    <li class="nav-item">
        <a class="nav-link {{ $menu == 'pengaturan' ? 'active' : '' }}" href="{{ url('pengaturan') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan</span></a>
    </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Penataan
    </div>


    <li class="nav-item">
        <a class="nav-link {{ $menu == 'pembentukankecamatan' ? 'active' : '' }}"
            href="{{ url('pembentukankecamatan') }}">
            <i class="fab fa-first-order-alt"></i>
            <span>Pembentukan Kecamatan</span></a>
    </li>


    @if (session('akseslevel') == 'Admin')


    @php
    $active = '';
    $menuopen = '';
    if (in_array($menu, ['lappembentukan'])) {
    $isactive = true;
    }else{
    $isactive = false;
    }
    @endphp


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!$isactive) collapsed @endif" href="#" data-toggle="collapse"
            data-target="#collapseFour" aria-expanded="@if ($isactive) false @else true @endif"
            aria-controls="collapseFour">
            <i class="fas fa-fw fa-cog"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseFour" class="collapse @if ($isactive) show @endif" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $menu == 'lappembentukan' ? 'active' : '' }}"
                    href="{{ url('lappembentukan') }}">Pembentukan Kecamatan</a>
            </div>
        </div>
    </li>


    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->