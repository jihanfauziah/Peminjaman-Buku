<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Peminjaman Buku</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('styles')
</head>
<body>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column" id="sidebar">
            <div class="brand">
                <i class="bi bi-book-half fs-3" style="color: var(--sidebar-active);"></i>
                <span>SIPEMBU Admin</span>
            </div>
            
            <ul class="nav flex-column mt-3 flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                        <i class="bi bi-journal-text"></i>
                        <span>Data Buku</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Data Anggota</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                        <i class="bi bi-arrow-left-right"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
            </ul>

            <div class="p-3 border-top border-secondary">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: var(--sidebar-active); color: #fff;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h6 class="mb-0 text-white text-truncate">{{ Auth::user()->name }}</h6>
                        <small class="text-muted d-block text-truncate">Administrator</small>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Navbar -->
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link text-dark p-0 me-3 d-md-none" id="sidebarToggle">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                    <h5 class="page-title">@yield('page_title', 'Dashboard')</h5>
                </div>
                <div class="text-muted d-none d-sm-block">
                    <i class="bi bi-clock me-1"></i> <span id="current-time"></span>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="container-fluid p-4">
                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-left: 4px solid #0d9488 !important;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5 text-teal" style="color: #0d9488;"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-left: 4px solid #dc3545 !important;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Toggle Sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Simple Clock
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    @yield('scripts')
</body>
</html>
