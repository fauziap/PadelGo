@php
    $isAuthenticated = auth()->check();

    $image = $court->image_url;

    if ($image && filter_var($image, FILTER_VALIDATE_URL)) {
        $imgSrc = $image;
    } elseif ($image && str_starts_with($image, '/storage/')) {
        $imgSrc = $image;
    } elseif ($image && str_starts_with($image, 'storage/')) {
        $imgSrc = asset($image);
    } elseif ($image) {
        $imgSrc = asset('storage/' . $image);
    } else {
        $imgSrc = 'https://static.the-independent.com/2025/07/21/07/13133936-3e8a64ab-8464-4eb0-b047-260fd332feba.jpg';
    }
@endphp

<x-landing-layout>
    <!-- Court Header Section -->
    <section class="court-header"
        style="background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url('{{ $imgSrc }}') center/cover no-repeat;">
        <div class="container">
            <a href="/#lapangan" class="btn btn-secondary rounded-pill mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali
            </a>

            <div class="court-header-content">
                <div class="court-price-tag">
                    Rp{{ number_format($court->price, 0, ',', '.') }} <span>/ 3 jam</span>
                </div>

                <h1 class="court-detail-title text-white">{{ $court->name }}</h1>

                <p class="lead text-white">
                    Lapangan padel modern dengan rumput sintetis premium, dinding kaca, dan pencahayaan nyaman untuk bermain.
                </p>
            </div>
        </div>
    </section>

    <!-- Court Details Section -->
    <section class="court-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Deskripsi Lapangan</h2>

                    <p class="lead mb-4">
                        Lapangan padel kami dirancang untuk memberikan pengalaman bermain yang nyaman,
                        seru, dan cocok untuk pemain pemula hingga berpengalaman.
                    </p>

                    <p>
                        Lapangan ini menggunakan ukuran standar padel 20m x 10m dengan area permainan
                        yang dikelilingi dinding kaca dan pagar mesh. Permukaan lapangan menggunakan
                        rumput sintetis khusus padel yang nyaman untuk bergerak, membantu kontrol bola,
                        serta mendukung permainan cepat seperti rally, volley, lob, dan smash.
                        Dilengkapi juga dengan sistem pencahayaan LED profesional agar aktivitas bermain
                        tetap nyaman pada siang maupun malam hari.
                    </p>

                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">Fasilitas Khusus</h3>

                        <ul class="feature-list">
                            <li>Rumput sintetis khusus padel yang nyaman dan tidak licin</li>
                            <li>Dinding kaca tempered untuk permainan pantulan bola</li>
                            <li>Pagar mesh standar lapangan padel</li>
                            <li>Sistem pencahayaan LED profesional</li>
                            <li>Area duduk pemain dan penonton</li>
                            <li>Locker pribadi dengan kunci elektronik</li>
                            <li>Shower dan area ganti pribadi</li>
                            <li>Free WiFi high speed</li>
                            <li>Raket padel dan bola padel tersedia untuk disewa</li>
                        </ul>
                    </div>

                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">Gallery Lapangan</h3>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="gallery-item">
                                    <img src="https://static.the-independent.com/2025/07/21/07/13133936-3e8a64ab-8464-4eb0-b047-260fd332feba.jpg"
                                        class="img-fluid w-100 h-100"
                                        alt="Aktivitas bermain padel di lapangan modern"
                                        style="object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="gallery-item">
                                    <img src="https://padelclubrotterdam.nl/wp-content/uploads/2022/09/DSC_5298-2MB-scaled.jpg"
                                        class="img-fluid w-100 h-100"
                                        alt="Pemain padel sedang melakukan rally di lapangan outdoor"
                                        style="object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="gallery-item">
                                    <img src="https://static.the-independent.com/2024/07/05/11/what-is-Padel-indybest.png"
                                        class="img-fluid w-100 h-100"
                                        alt="Pemain padel memegang raket padel di area lapangan"
                                        style="object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--
                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">Testimoni</h3>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="testimonial-card">
                                    <div class="d-flex mb-3">
                                        <img src="https://placehold.co/100x100" class="testimonial-img"
                                            alt="Profil pengguna laki-laki tersenyum">

                                        <div>
                                            <h5 class="mb-1">Budi Santoso</h5>

                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p>
                                        "Lapangan padelnya nyaman, bersih, dan pencahayaannya bagus.
                                        Cocok untuk main santai maupun latihan serius."
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="testimonial-card">
                                    <div class="d-flex mb-3">
                                        <img src="https://placehold.co/100x100" class="testimonial-img"
                                            alt="Profil pengguna perempuan tersenyum">

                                        <div>
                                            <h5 class="mb-1">Ani Wijaya</h5>

                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p>
                                        "Fasilitasnya lengkap, ada area ganti dan raket padel yang bisa disewa.
                                        Harga sesuai dengan kualitas lapangannya."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                </div>

                <!-- Booking Form Sidebar -->
                <div class="col-lg-4">
                    <div class="" style="top: 20px;">
                        <div class="booking-form-card">
                            <div class="form-header">
                                <h3 class="fw-bold">Formulir Booking</h3>
                                <p class="text-muted m-0">Isi data untuk memesan lapangan padel</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="bookingForm" method="POST" action="/dashboard/books">
                                @csrf

                                <div class="mb-3">
                                    <label for="bookingPhone" class="form-label">
                                        Nomor Telepon <span class="text-danger">*</span>
                                    </label>

                                    <input type="tel"
                                        class="form-control"
                                        id="bookingPhone"
                                        name="phone_number"
                                        pattern="^(08|\+628)[0-9]{7,11}$"
                                        placeholder="Contoh: 081234567890"
                                        value="{{ old('phone_number') }}">

                                    <div class="form-text">Masukkan nomor telepon diawali 08 atau +628</div>
                                </div>

                                <div class="mb-3">
                                    <label for="bookingDate" class="form-label">
                                        Tanggal Booking <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                        name="booking_date"
                                        class="form-control"
                                        value="{{ $selectedDate ?? date('Y-m-d') }}"
                                        min="{{ date('Y-m-d') }}"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label d-block">
                                        Jam tersedia <span class="text-danger">*</span>
                                    </label>

                                    <div class="d-flex flex-wrap mb-2">
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $isBooked = $books->contains(function ($book) use ($schedule) {
                                                    return $book->schedule->id === $schedule->id;
                                                });
                                            @endphp

                                            <span class="time-slot-btn {{ $isBooked ? 'disabled' : '' }}"
                                                data-id="{{ $schedule->id }}">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <small class="text-muted">Jam operasional: 10:00-22:00 WIB</small>

                                    <input type="hidden" name="schedule_id" id="scheduleId">
                                </div>

                                <input type="hidden" name="court_id" value="{{ $court->id }}">

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary py-3 fw-bold">
                                        <i class="fas fa-calendar-check me-2"></i> Pesan Sekarang
                                    </button>
                                </div>

                                <div class="mt-3 text-center">
                                    <small class="text-muted">
                                        Kami akan mengirim konfirmasi ke nomor telepon Anda dalam 15 menit
                                    </small>
                                </div>
                            </form>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-info-circle me-2"></i> Info Penting
                                </h5>

                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Free bola padel untuk pemesanan lebih dari 2 jam
                                    </li>

                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Raket padel tersedia untuk disewa di lokasi
                                    </li>

                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Parkir motor gratis
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>

<script>
    document.getElementById('bookingPhone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.time-slot-btn');

        buttons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (btn.classList.contains('disabled')) {
                    return;
                }

                const scheduleIdInput = document.getElementById('scheduleId');

                const id = btn.getAttribute('data-id');
                scheduleIdInput.value = id;

                buttons.forEach(b => b.classList.remove('selected'));

                btn.classList.add('selected');
            });
        });
    });
</script>
