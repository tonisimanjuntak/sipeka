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

            <li class="nav-item">
                <a class="nav-link {{ $menu == 'kabupaten' ? 'active' : '' }}" href="{{ url('kabupaten') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kabupaten</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $menu == 'kecamatan' ? 'active' : '' }}" href="{{ url('kecamatan') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kecamatan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $menu == 'kelurahan' ? 'active' : '' }}" href="{{ url('kelurahan') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelurahan</span></a>
            </li>


            {{-- @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['jenistryout', 'kategori', 'banksoal', 'formasiasn', 'formasibidang'])) {
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
                    <span>Lainnya</span>
                </a>
                <div id="collapseTwo" class="collapse @if ($isactive) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ $menu == 'formasibidang' ? 'active' : '' }}" href="{{ url('formasibidang') }}">Bidang Formasi ASN</a>
                        <a class="collapse-item {{ $menu == 'formasiasn' ? 'active' : '' }}" href="{{ url('formasiasn') }}">Formasi ASN</a>
                        <a class="collapse-item {{ $menu == 'jenistryout' ? 'active' : '' }}" href="{{ url('jenistryout') }}">Jenis Tryout</a>
                        <a class="collapse-item {{ $menu == 'kategori' ? 'active' : '' }}" href="{{ url('kategori') }}">Kategori Soal</a>
                        <a class="collapse-item {{ $menu == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}">Bank Soal</a>
                    </div>
                </div>
            </li> --}}

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