<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://simrs.herminahospitals.com/live" class="nav-link" target="_BLANK">Hinai Web</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="https://sites.google.com/herminahospitals.com/rsherminapalembang?utm_source=driv" class="nav-link"
                target="_BLANK">Portal Web</a>
        </li> --}}
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-fw fa-user"></i>
                {{ request()->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ request()->user()->username }}</span>
                <div class="dropdown-divider"></div>
                @if (auth()->user()->hasRole('IT SUPPORT'))
                    <a href="{{ route('setting.index') }}" class="dropdown-item">
                        <i class="fas fa-fw fa-cog mr-2"></i> Setting
                    </a>
                @endif
                <a href="#" class="dropdown-item">
                    <i class="fas fa-fw fa-user mr-2"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        <i class="fas fa-fw fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
