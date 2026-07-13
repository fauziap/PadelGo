<x-dashboard-layout>
    <style>
        .booking-mobile-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        .booking-mobile-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 12px;
        }

        .booking-info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px dashed #e5e7eb;
            font-size: 14px;
        }

        .booking-info-row:last-child {
            border-bottom: none;
        }

        .booking-info-label {
            color: #6b7280;
            min-width: 110px;
        }

        .booking-info-value {
            font-weight: 600;
            text-align: right;
        }

        .booking-failed-box {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 600;
            text-align: center;
            cursor: not-allowed;
        }

        .booking-success-box {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 600;
            text-align: center;
        }

        .booking-challenge-box {
            background: #e0f2fe;
            color: #075985;
            border: 1px solid #bae6fd;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 768px) {
            .booking-header {
                gap: 16px;
            }

            .booking-header h2 {
                font-size: 24px;
            }

            .booking-header .btn {
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4 booking-header">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    <i class="fas fa-basketball-ball me-2"></i>My Booking
                </h2>
            </div>

            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a class="btn btn-primary-custom" href="/#lapangan">
                    <i class="fas fa-plus me-2"></i>Booking Now
                </a>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-body">

                {{-- Tampilan Desktop --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Booking Date</th>
                                <th class="text-center">Court</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Phone Number</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                                class="court-img me-3">
                                            <span class="fw-medium">{{ $book->court->name }}</span>
                                        </div>
                                    </td>

                                    <td>{{ $book->user->first_name }}</td>

                                    <td>
                                        Rp{{ number_format($book->court->price, 0, ',', '.') }}
                                    </td>

                                    <td>{{ $book->phone_number }}</td>

                                    <td>{{ $book->schedule->start_time }}</td>

                                    <td>{{ $book->schedule->end_time }}</td>

                                    <td class="text-center">
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
                                                <i class="fas fa-times-circle me-1"></i>Booking Gagal
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($book->payment_status === 'pending' || $book->payment_status === 'challenge')
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-primary btn-sm"
                                                    href="/payment-confirmation/book/{{ $book->id }}">
                                                    Bayar
                                                </a>

                                                <form action="/dashboard/books/{{ $book->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif ($book->payment_status === 'failed')
                                            <div class="booking-failed-box">
                                                <i class="fas fa-ban me-1"></i> Tidak Bisa Diproses
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm w-100" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $book->id }}">
                                                <i class="fas fa-qrcode me-1"></i> Lihat QR
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">
                                        Belum ada booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Tampilan Mobile --}}
                <div class="d-lg-none">
                    @forelse ($books as $book)
                        <div class="booking-mobile-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ Str::substr($book->court->image_url, 0, 12) === 'court_images' ? '/storage/' . $book->court->image_url : $book->court->image_url }}"
                                    class="booking-mobile-img me-3">

                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $book->court->name }}</h5>

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
                                            <i class="fas fa-times-circle me-1"></i>Booking Gagal
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="booking-info-row">
                                <span class="booking-info-label">Tanggal</span>
                                <span class="booking-info-value">
                                    {{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}
                                </span>
                            </div>

                            <div class="booking-info-row">
                                <span class="booking-info-label">Nama</span>
                                <span class="booking-info-value">{{ $book->user->first_name }}</span>
                            </div>

                            <div class="booking-info-row">
                                <span class="booking-info-label">Harga</span>
                                <span class="booking-info-value">
                                    Rp{{ number_format($book->court->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="booking-info-row">
                                <span class="booking-info-label">No. Telepon</span>
                                <span class="booking-info-value">{{ $book->phone_number }}</span>
                            </div>

                            <div class="booking-info-row">
                                <span class="booking-info-label">Jam</span>
                                <span class="booking-info-value">
                                    {{ $book->schedule->start_time }} - {{ $book->schedule->end_time }}
                                </span>
                            </div>

                            <div class="mt-3">
                                @if ($book->payment_status === 'pending' || $book->payment_status === 'challenge')
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary"
                                            href="/payment-confirmation/book/{{ $book->id }}">
                                            Bayar Sekarang
                                        </a>

                                        <form action="/dashboard/books/{{ $book->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">
                                                Batalkan Booking
                                            </button>
                                        </form>
                                    </div>
                                @elseif ($book->payment_status === 'failed')
                                    <div class="booking-failed-box">
                                        <i class="fas fa-ban me-1"></i>
                                        Booking Gagal / Dibatalkan
                                    </div>
                                @else
                                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $book->id }}">
                                        <i class="fas fa-qrcode me-1"></i> Lihat QR & Detail
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            Belum ada booking.
                        </div>
                    @endforelse
                </div>
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
                                <p class="text-muted mt-2 small">Tunjukkan QR Code ini kepada petugas</p>
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
