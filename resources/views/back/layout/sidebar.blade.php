<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/article') }}" class="nav-link">
                    <i class="fa-solid fa-newspaper"></i> Artikel
                </a>
            </li>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ url('/tenaga-medis') }}" class="nav-link">
                        <i class="fa-solid fa-user-doctor"></i> Tenaga Medis
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/obat') }}" class="nav-link">
                        <i class="fa-solid fa-kit-medical"></i> Obat
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/reservasi') }}" class="nav-link d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fa-solid fa-envelope"></i> Reservasi
                        </div>

                        @if(isset($pendingReservasiCount) && $pendingReservasiCount > 0)
                            <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                {{ $pendingReservasiCount > 99 ? '99+' : $pendingReservasiCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/transaksi') }}" class="nav-link">
                        <i class="fa-solid fa-receipt"></i> Transaksi
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </li>

        </ul>
    </div>
</nav>
