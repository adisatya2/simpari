<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
        <img src="{{ asset('/') }}dist/img/Logo Hermina.png" alt="AdminLTE Logo" class="brand-image elevation-3 mr-0"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child text-sm"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link {{ request()->segment(1) == null || request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="fa-fw fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->hasRole('IT SUPPORT'))
                <li class="nav-item  {{ request()->segment(1) == 'admin' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-fw fas fa-user-cog nav-icon"></i>
                        <p>
                            Administrator
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ request()->segment(1) == 'admin' && request()->segment(2) == 'user' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-fw fas fa-user-tag nav-icon"></i>
                                <p>Data Role</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @endif
                @if (auth()->user()->hasRole(['IT SUPPORT','FRONT OFFICE']))
                <li class="nav-item {{ request()->segment(1) == 'master' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->segment(1) == 'master' ? 'active' : '' }}">
                        <i class="fa-fw fas fa-database nav-icon"></i>
                        <p>
                            Data master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pasien.index') }}"
                                class="nav-link {{ request()->segment(1) == 'master' && request()->segment(2) == 'pasien' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon"></i>
                                <p>Data Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dokter.index') }}"
                                class="nav-link {{ request()->segment(1) == 'master' && request()->segment(2) == 'dokter' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user-md nav-icon"></i>
                                <p>Data Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruangan.index') }}"
                                class="nav-link {{ request()->segment(1) == 'master' && request()->segment(2) == 'ruangan' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-clinic-medical nav-icon"></i>
                                <p>Data Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bed.index') }}"
                                class="nav-link {{ request()->segment(1) == 'master' && request()->segment(2) == 'bed' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-bed nav-icon"></i>
                                <p>Data Tempat Tidur</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item {{ request()->segment(1) == 'bedmanagement' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-fw fas fa-hospital-alt nav-icon"></i>
                        <p>
                            Bed Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pasiendirawat.index') }}"
                                class="nav-link {{ request()->segment(1) == 'bedmanagement' && request()->segment(2) == 'pasiendirawat' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-procedures nav-icon"></i>
                                <p>Pasien Sedang Dirawat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pasienpulang.index') }}"
                                class="nav-link {{ request()->segment(1) == 'bedmanagement' && request()->segment(2) == 'pasienpulang' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-hospital-user nav-icon"></i>
                                <p>Pasien Pulang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->hasRole(['IT SUPPORT','IPCN/PPI','PERAWAT','MUTU DAN AKREDITASI','DIREKSI']))
                <li
                    class="nav-item {{ request()->segment(1) == 'surveilans' || request()->segment(1) == 'laporanhais' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-fw fas fa-virus nav-icon"></i>
                        <p>
                            Surveilans
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('surveilans.index') }}"
                                class="nav-link {{ request()->segment(1) == 'surveilans' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-folder-plus nav-icon"></i>
                                <p>Input Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporanhais.index') }}"
                                class="nav-link {{ request()->segment(1) == 'laporanhais' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-tasks nav-icon"></i>
                                <p>Laporan HAIs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->hasRole(['IT SUPPORT','PERAWAT','PANTRY/GIZI','MUTU DAN AKREDITASI','DIREKSI']))
                <li class="nav-item {{ request()->segment(1) == 'gizi' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-fw fas fa-utensils nav-icon"></i>
                        <p>
                            Gizi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('gizi.index') }}"
                                class="nav-link {{ request()->segment(1) == 'gizi' ? 'active' : '' }}">
                                <i class="fa-fw fas fa-procedures nav-icon"></i>
                                <p>Pasien Sedang Dirawat</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-fw fas fa-folder-open nav-icon"></i>
                                <p>Log Data</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>