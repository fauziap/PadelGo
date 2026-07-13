<div class="sidebar bg-white w-100 d-flex flex-column">
    <div class="p-3 border-bottom text-center">
        <a class="h5 fw-bold text-primary mb-0 text-decoration-none" href="/">
            <i class="fas fa-table-tennis-paddle-ball me-2"></i>
            GOR Padel
        </a>
        <button class="btn btn-link text-secondary me-3 humberger-2">
            <i class="fas fa-close fs-2"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="d-flex flex-column flex-grow-1">
        <div class="p-2 flex-grow-1">
            <div class="d-grid gap-2">
                @can('admin')
                    <a href="/dashboard"
                        class="btn {{ request()->is('dashboard') ? 'btn-primary text-white' : 'btn-light' }} d-flex align-items-center">
                        <i class="fas fa-tachometer-alt me-3"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="/dashboard/books"
                        class="btn {{ request()->is('dashboard/books') ? 'btn-primary text-white' : 'btn-light' }} d-flex align-items-center text-dark">
                        <i class="fas fa-calendar-check me-3"></i>
                        <span class="nav-text">Manage Booking</span>
                    </a>
                    <a href="/dashboard/courts"
                        class="btn {{ request()->is('dashboard/courts') ? 'btn-primary text-white' : 'btn-light' }} d-flex align-items-center text-dark">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <span class="nav-text">Manage Courts</span>
                    </a>
                    <a href="/dashboard/schedules"
                        class="btn {{ request()->is('dashboard/schedules') ? 'btn-primary text-white' : 'btn-light' }} d-flex align-items-center text-dark">
                        <i class="fa-solid fa-calendar-xmark me-3"></i>
                        <span class="nav-text">Manage Schedules</span>
                    </a>
                @endcan
                @auth
                    @if (auth()->user()->role !== 'admin')
                        <a href="/dashboard/booking-history"
                            class="btn {{ request()->is('dashboard/booking-history') ? 'btn-primary text-white' : 'btn-light' }} d-flex align-items-center text-dark">
                            <i class="fa-solid fa-clock-rotate-left me-3"></i>
                            <span class="nav-text">Booking History</span>
                        </a>
                    @endif
                    <button type="button" class="btn btn-light d-flex align-items-center text-dark" data-bs-toggle="modal"
                        data-bs-target="#profileSetting">
                        <i class="fas fa-cog me-3"></i>
                        <span class="nav-text">Account Settings</span>
                    </button>
                @endauth

                <hr class="divider">
                </hr>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="d-flex align-items-center btn btn-light text-dark w-100"><i
                            class="fa-solid fa-door-open me-3"></i>
                        <span class="nav-text">Logout</span></button>
                </form>
            </div>
        </div>

        <!-- User Info -->
        <div class="p-3 border-top d-flex align-items-center">
            <img src="{{ $profileUrl }}" class="rounded-circle me-3" alt="Admin profile picture" width="40"
                height="40">
            <div>
                <p class="mb-0 fw-medium text-dark">{{ auth()->user()->first_name }} </p>
                <small class="text-muted">{{ Str::title(auth()->user()->role) }}</small>
            </div>
        </div>
    </nav>
</div>
