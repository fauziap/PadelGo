<x-dashboard-layout>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: #2a4365;">
                    <i class="fas fa-calendar-alt me-2"></i>Manage Bookings
                </h2>
                <p class="text-muted">Admin dashboard to manage padel court bookings</p>
            </div>

            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                {{-- <a href="{{ url('/dashboard/books/export') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}"
                    class="btn btn-success">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </a> --}}
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card total">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Bookings</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalBookings }}</h3>
                            </div>
                            <div class="bg-light-primary rounded-circle p-3">
                                <i class="fas fa-calendar text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card confirmed">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Confirmed</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalConfirmedBookings }}</h3>
                            </div>
                            <div class="bg-light-success rounded-circle p-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card pending">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Pending</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalPendingBookings }}</h3>
                            </div>
                            <div class="bg-light-warning rounded-circle p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card card-custom h-100 stats-card cancelled">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Challenge</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalChallengeBookings }}</h3>
                            </div>
                            <div class="bg-light-warning rounded-circle p-3">
                                <i class="fas fa-shield-alt text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-body">

                <form action="{{ url('/dashboard/books') }}" method="GET" class="row g-3 align-items-end mb-4">
    <div class="col-lg-3 col-md-6">
        <label class="form-label small text-muted">Search</label>
        <div class="position-relative">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="keyword" class="form-control search-box"
                placeholder="Search user / court / email / phone"
                value="{{ request('keyword') }}" autocomplete="off">
        </div>
    </div>

    <div class="col-lg-2 col-md-6">
        <label class="form-label small text-muted">Dari Tanggal</label>
        <input type="date" name="date_from" class="form-control"
            value="{{ request('date_from') }}">
    </div>

    <div class="col-lg-2 col-md-6">
        <label class="form-label small text-muted">Sampai Tanggal</label>
        <input type="date" name="date_to" class="form-control"
            value="{{ request('date_to') }}">
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label small text-muted">Status</label>
        <select class="form-select filter-btn" name="status">
            <option value="">All Status</option>
            <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>
                Confirmed
            </option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                Pending
            </option>
            <option value="challenge" {{ request('status') === 'challenge' ? 'selected' : '' }}>
                Challenge
            </option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>
                Failed
            </option>
        </select>
    </div>

    <div class="col-lg-2 col-md-6">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-filter me-1"></i>Filter
        </button>
    </div>

    <div class="col-12">
        <div class="d-flex flex-wrap gap-2 justify-content-between">
            <a href="{{ url('/dashboard/books') }}" class="btn btn-outline-secondary">
                <i class="fas fa-undo me-1"></i>Reset Filter
            </a>

            <a href="{{ url('/dashboard/books/export') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}"
                class="btn btn-success">
                <i class="fas fa-file-excel me-1"></i>Export Laporan
            </a>
        </div>
    </div>
</form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Court</th>
                                <th>Customer</th>
                                <th>Booking Date</th>
                                <th>Time Slot</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $books->firstItem() + $loop->index }}</td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                                alt="Court Image"
                                                class="court-img me-3">

                                            <span class="fw-medium">{{ $book->court->name }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">
                                                {{ $book->user->first_name }} {{ $book->user->last_name ?? '' }}
                                            </span>
                                            <small class="text-muted">{{ $book->user->email ?? '-' }}</small>
                                            <small class="text-muted">{{ $book->phone_number }}</small>
                                        </div>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($book->booking_date)->format('d F Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">
                                                {{ $book->schedule->start_time }} - {{ $book->schedule->end_time }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">
                                                Rp{{ number_format($book->court->price, 0, ',', '.') }}
                                            </span>

                                            @if ($book->payment_status == 'success')
                                                <small class="text-success">Paid</small>
                                            @elseif ($book->payment_status == 'pending')
                                                <small class="text-warning">Pending</small>
                                            @elseif ($book->payment_status == 'challenge')
                                                <small class="text-info">Challenge</small>
                                            @elseif ($book->payment_status == 'failed')
                                                <small class="text-danger">Failed</small>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        @if ($book->payment_status === 'pending')
                                            <span class="badge-status badge-pending">
                                                <i class="fas fa-hourglass-half me-1"></i>Waiting Payment
                                            </span>
                                        @elseif ($book->payment_status === 'success')
                                            <span class="badge-status badge-success mb-2 d-inline-block">
                                                <i class="fas fa-check-circle me-1"></i>Paid
                                            </span><br>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $book->id }}">
                                                <i class="fas fa-qrcode"></i> Lihat QR
                                            </button>
                                        @elseif ($book->payment_status === 'challenge')
                                            <span class="badge-status badge-warning">
                                                <i class="fas fa-shield-alt me-1"></i>Challenge
                                            </span>
                                        @else
                                            <span class="badge-status badge-failed">
                                                <i class="fas fa-times-circle me-1"></i>Failed
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada data booking sesuai filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    @foreach ($books as $book)
        @if ($book->payment_status === 'success')
            <!-- Modal QR -->
            <div class="modal fade" id="qrModal-{{ $book->id }}" tabindex="-1" aria-labelledby="qrModalLabel-{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="qrModalLabel-{{ $book->id }}">Detail Booking & QR Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center pt-2">
                            <div class="mb-4 mt-2">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($book->order_id) }}" alt="QR Code" class="img-fluid rounded shadow-sm border p-2" style="max-width: 250px; background: white;">
                            </div>
                            <h5 class="fw-bold text-primary mb-1">{{ $book->court->name }}</h5>
                            <p class="text-muted mb-0 fw-medium">{{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}</p>
                            <p class="text-muted mb-3">{{ $book->schedule->start_time }} - {{ $book->schedule->end_time }}</p>
                            
                            <div class="bg-light p-3 rounded text-start">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Order ID</span>
                                    <span class="fw-medium">{{ $book->order_id }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nama</span>
                                    <span class="fw-medium">{{ $book->user->first_name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">No. Telepon</span>
                                    <span class="fw-medium">{{ $book->phone_number }}</span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Total Pembayaran</span>
                                    <span class="fw-bold fs-5 text-success">Rp{{ number_format($book->court->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

</x-dashboard-layout>
