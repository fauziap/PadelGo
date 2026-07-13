@php
    use Illuminate\Support\Str;
@endphp

<x-dashboard-layout>
    <style>
        .dashboard-title {
            color: #1e293b;
            font-weight: 800;
        }

        .dashboard-subtitle {
            color: #64748b;
        }

        .filter-card,
        .stat-card,
        .chart-card,
        .recent-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .stat-card {
            transition: .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            font-size: 22px;
        }

        .top-court-item {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 12px;
            background: #fff;
        }

        .court-rank {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            margin-right: 10px;
        }

        .mobile-booking-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 14px;
            background: #fff;
        }

        .mobile-booking-img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 7px 0;
            border-bottom: 1px dashed #e5e7eb;
            font-size: 14px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 24px;
            }

            .chart-card canvas {
                max-height: 260px;
            }
        }
    </style>

    <div class="container-fluid py-4">

        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h2 class="dashboard-title mb-1">
                    <i class="fas fa-chart-line me-2"></i>Dashboard Overview
                </h2>
                <p class="dashboard-subtitle mb-0">
                    Ringkasan booking, pendapatan, status pembayaran, dan performa lapangan padel.
                </p>
            </div>

            <div class="col-md-4 mt-3 mt-md-0 text-md-end">
                <span class="badge bg-primary fs-6 px-3 py-2">
                    {{ $periodLabel }}
                </span>
            </div>
        </div>

        {{-- Filter Range Tanggal --}}
        <div class="card filter-card mb-4">
            <div class="card-body">
                <form action="{{ url('/dashboard') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small text-muted">Dari Tanggal</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $dateFromValue }}">
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small text-muted">Sampai Tanggal</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $dateToValue }}">
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> Terapkan Filter
                        </button>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-undo me-1"></i> Reset 7 Hari
                        </a>
                    </div>
                </form>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="{{ url('/dashboard?date_from=' . now()->format('Y-m-d') . '&date_to=' . now()->format('Y-m-d')) }}"
                        class="btn btn-sm btn-primary">
                        Hari Ini
                    </a>

                    <a href="{{ url('/dashboard?date_from=' . now()->subDays(6)->format('Y-m-d') . '&date_to=' . now()->format('Y-m-d')) }}"
                        class="btn btn-sm btn-outline-primary">
                        7 Hari Terakhir
                    </a>

                    <a href="{{ url('/dashboard?date_from=' . now()->subDays(13)->format('Y-m-d') . '&date_to=' . now()->format('Y-m-d')) }}"
                        class="btn btn-sm btn-outline-primary">
                        14 Hari Terakhir
                    </a>

                    <a href="{{ url('/dashboard?date_from=' . now()->subDays(29)->format('Y-m-d') . '&date_to=' . now()->format('Y-m-d')) }}"
                        class="btn btn-sm btn-outline-primary">
                        30 Hari Terakhir
                    </a>

                    <a href="{{ url('/dashboard?date_from=' . now()->startOfMonth()->format('Y-m-d') . '&date_to=' . now()->format('Y-m-d')) }}"
                        class="btn btn-sm btn-outline-primary">
                        Bulan Ini
                    </a>
                </div>
            </div>
        </div>

        {{-- Main Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Total Bookings</div>
                            <div class="fs-4 fw-bold">{{ $totalBookings }}</div>
                            <small class="text-muted">Sesuai range tanggal</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Revenue</div>
                            <div class="fs-5 fw-bold">Rp {{ number_format($periodRevenue, 0, ',', '.') }}</div>
                            <small class="text-muted">Dari booking sukses</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Active Members</div>
                            <div class="fs-4 fw-bold">{{ $totalMember }}</div>
                            <small class="text-muted">User non-admin</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Total Courts</div>
                            <div class="fs-4 fw-bold">{{ $totalCourts }}</div>
                            <small class="text-muted">Total lapangan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Confirmed</div>
                            <div class="fs-4 fw-bold">{{ $totalSuccessBookings }}</div>
                            <small class="text-success">Paid / success</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Pending</div>
                            <div class="fs-4 fw-bold">{{ $totalPendingBookings }}</div>
                            <small class="text-warning">Menunggu pembayaran</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Challenge</div>
                            <div class="fs-4 fw-bold">{{ $totalChallengeBookings }}</div>
                            <small class="text-primary">Perlu pengecekan</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Failed</div>
                            <div class="fs-4 fw-bold">{{ $totalFailedBookings }}</div>
                            <small class="text-danger">Gagal / dibatalkan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary + Status Chart --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card chart-card p-4 h-100">
                    <h5 class="mb-1 fw-bold">Business Summary</h5>
                    <small class="text-muted">Data global sistem</small>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-info bg-opacity-10">
                                <div class="text-muted small">Active Members</div>
                                <div class="fs-4 fw-bold text-info">{{ $totalMember }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-warning bg-opacity-10">
                                <div class="text-muted small">Total Courts</div>
                                <div class="fs-4 fw-bold text-warning">{{ $totalCourts }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ url('/dashboard/books') }}" class="btn btn-primary">
                            <i class="fas fa-list me-1"></i> Manage Bookings
                        </a>

                        <a href="{{ url('/dashboard/courts') }}" class="btn btn-outline-primary">
                            <i class="fas fa-map-marker-alt me-1"></i> Manage Courts
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card chart-card p-4 h-100">
                    <h5 class="mb-1 fw-bold">Booking Status</h5>
                    <small class="text-muted">Status booking sesuai range tanggal</small>

                    <canvas id="statusChart" height="220"></canvas>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-6">
                <div class="card chart-card p-4 h-100">
                    <h5 class="mb-1 fw-bold">Booking Trends</h5>
                    <small class="text-muted">Jumlah booking per hari sesuai range tanggal</small>

                    <canvas id="bookingTrendChart" height="300"></canvas>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card chart-card p-4 h-100">
                    <h5 class="mb-1 fw-bold">Revenue Trends</h5>
                    <small class="text-muted">Pendapatan per hari dari booking sukses</small>

                    <canvas id="revenueTrendChart" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Courts + Recent Bookings --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-4">
                <div class="card chart-card p-4 h-100">
                    <h5 class="mb-1 fw-bold">Top Courts</h5>
                    <small class="text-muted">Lapangan paling sering dibooking sesuai range</small>

                    <div class="mt-3">
                        @forelse ($topCourts as $court)
                            <div class="top-court-item">
                                <div class="d-flex align-items-start">
                                    <span class="court-rank">{{ $loop->iteration }}</span>

                                    <div class="flex-grow-1">
                                        <div class="fw-bold">{{ $court['name'] }}</div>
                                        <small class="text-muted">
                                            {{ $court['total_bookings'] }} booking sukses
                                        </small>

                                        <div class="fw-semibold text-success mt-1">
                                            Rp {{ number_format($court['total_revenue'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                Belum ada booking sukses pada range ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card recent-card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Recent Bookings</h5>
                            <small class="text-muted">Booking terbaru sesuai range tanggal</small>
                        </div>

                        <a href="{{ url('/dashboard/books') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>

                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover align-middle mb-0">
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
                                @forelse ($books as $key => $book)
                                    <tr>
                                        <td>{{ $books->firstItem() + $key }}</td>

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
                                                <small class="text-muted">{{ $book->phone_number }}</small>
                                            </div>
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($book->booking_date)->format('d F Y') }}</td>

                                        <td>
                                            <span class="fw-medium">
                                                {{ $book->schedule->start_time }} - {{ $book->schedule->end_time }}
                                            </span>
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
                                            Belum ada booking pada range tanggal ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-lg-none p-3">
                        @forelse ($books as $book)
                            <div class="mobile-booking-card">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                        class="mobile-booking-img me-3">

                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $book->court->name }}</h6>

                                        @if ($book->payment_status === 'pending')
                                            <span class="badge-status badge-pending">
                                                <i class="fas fa-hourglass-half me-1"></i>Waiting Payment
                                            </span>
                                        @elseif ($book->payment_status === 'success')
                                            <span class="badge-status badge-success">
                                                <i class="fas fa-check-circle me-1"></i>Paid
                                            </span>
                                        @elseif ($book->payment_status === 'challenge')
                                            <span class="badge-status badge-warning">
                                                <i class="fas fa-shield-alt me-1"></i>Challenge
                                            </span>
                                        @else
                                            <span class="badge-status badge-failed">
                                                <i class="fas fa-times-circle me-1"></i>Failed
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="info-row">
                                    <span class="text-muted">Customer</span>
                                    <strong>{{ $book->user->first_name }}</strong>
                                </div>

                                <div class="info-row">
                                    <span class="text-muted">Tanggal</span>
                                    <strong>{{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}</strong>
                                </div>

                                <div class="info-row">
                                    <span class="text-muted">Jam</span>
                                    <strong>{{ $book->schedule->start_time }} - {{ $book->schedule->end_time }}</strong>
                                </div>

                                <div class="info-row">
                                    <span class="text-muted">Harga</span>
                                    <strong>Rp{{ number_format($book->court->price, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                Belum ada booking pada range tanggal ini.
                            </div>
                        @endforelse
                    </div>

                    <div class="card-footer bg-light">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @foreach ($recentBooks as $book)
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const rupiah = (value) => {
        return 'Rp ' + Number(value).toLocaleString('id-ID');
    };

    const chartTextColor = '#64748b';
    const chartGridColor = 'rgba(148, 163, 184, 0.25)';

    const bookingTrendData = @json($bookingTrend);
    const revenueTrendData = @json($revenueTrend);
    const statusBreakdown = @json($statusBreakdown);

    const bookingTrendLabels = bookingTrendData.map(item => {
        return new Date(item.date).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short'
        });
    });

    const bookingTrendTotals = bookingTrendData.map(item => item.total);

    new Chart(document.getElementById('bookingTrendChart'), {
        type: 'line',
        data: {
            labels: bookingTrendLabels,
            datasets: [{
                label: 'Total Booking',
                data: bookingTrendTotals,
                fill: true,
                backgroundColor: 'rgba(59, 130, 246, 0.12)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointRadius: 4,
                tension: 0.35
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: chartTextColor
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: chartTextColor
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: chartTextColor,
                        precision: 0
                    },
                    grid: {
                        color: chartGridColor
                    }
                }
            }
        }
    });

    const revenueTrendLabels = Object.keys(revenueTrendData).map(date => {
        return new Date(date).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short'
        });
    });

    const revenueTrendTotals = Object.values(revenueTrendData);

    new Chart(document.getElementById('revenueTrendChart'), {
        type: 'bar',
        data: {
            labels: revenueTrendLabels,
            datasets: [{
                label: 'Revenue',
                data: revenueTrendTotals,
                backgroundColor: 'rgba(34, 197, 94, 0.75)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: chartTextColor
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return rupiah(context.raw);
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: chartTextColor
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: chartTextColor,
                        callback: function(value) {
                            return rupiah(value);
                        }
                    },
                    grid: {
                        color: chartGridColor
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(statusBreakdown),
            datasets: [{
                data: Object.values(statusBreakdown),
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: chartTextColor,
                        padding: 16
                    }
                }
            }
        }
    });
</script>
