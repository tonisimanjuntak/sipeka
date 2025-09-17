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

            <li class="nav-item">
                <a class="nav-link {{ $menu == 'pengguna' ? 'active' : '' }}" href="{{ url('pengguna') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Operator</span></a>
            </li>

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
                <div id="collapseTwo" class="collapse @if ($isactive) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ $menu == 'kabupaten' ? 'active' : '' }}" href="{{ url('kabupaten') }}">Kabupaten</a>
                        <a class="collapse-item {{ $menu == 'kecamatan' ? 'active' : '' }}" href="{{ url('kecamatan') }}">Kecamatan</a>
                        <a class="collapse-item {{ $menu == 'kelurahan' ? 'active' : '' }}" href="{{ url('kelurahan') }}">Kelurahan/ Desa</a>
                    </div>
                </div>
            </li>

            @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['persyaratandasar', 'persyaratanadministratif', 'persyaratanteknis'])) {
                    $isactive = true;                
                }else{
                    $isactive = false;
                }
            @endphp

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link @if (!$isactive) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="@if ($isactive) false @else true @endif" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Syarat</span>
                </a>
                <div id="collapseThree" class="collapse @if ($isactive) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ $menu == 'persyaratandasar' ? 'active' : '' }}" href="{{ url('persyaratandasar') }}">Persyaratan Dasar</a>
                        <a class="collapse-item {{ $menu == 'persyaratanadministratif' ? 'active' : '' }}" href="{{ url('persyaratanadministratif') }}">Persyaratan Administratif</a>
                        <a class="collapse-item {{ $menu == 'persyaratanteknis' ? 'active' : '' }}" href="{{ url('persyaratanteknis') }}">Persyaratan Teknis</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $menu == 'pengaturan' ? 'active' : '' }}" href="{{ url('pengaturan') }}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Penataan
            </div>


            <li class="nav-item">
                <a class="nav-link {{ $menu == 'pengajuan' ? 'active' : '' }}" href="{{ url('pengajuan') }}">
                    <i class="fab fa-first-order-alt"></i>
                    <span>Pengajuan</span></a>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">Laporan Pengajuan</a>                        
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->