<header class="bg-white shadow-sm d-flex justify-content-between align-items-center ">
    <div class="d-flex align-items-center">
        <button class="btn btn-link text-secondary me-3 humberger">
            <i class="fas fa-bars"></i>
        </button>
        <h2 class="h5 mb-0 fw-semibold">Dashboard Overview</h2>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center">
            <img src="{{ $profileUrl }}" alt="User profile picture" class="rounded-circle me-2" width="32" height="32">
            <span class="d-none d-md-inline">{{ auth()->user()->first_name }} </span>
        </div>
    </div>
</header>
