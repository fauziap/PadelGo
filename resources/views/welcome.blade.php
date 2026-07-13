@php
    use Illuminate\Support\Str;
@endphp

<x-landing-layout>
    <style>
        :root {
            --padel-primary: #16a34a;
            --padel-dark: #0f172a;
            --padel-soft: #ecfdf5;
            --padel-muted: #64748b;
            --padel-accent: #22c55e;
        }

        .padel-hero {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background:
                linear-gradient(120deg, rgba(15, 23, 42, 0.88), rgba(22, 163, 74, 0.72)),
                url('https://plus.unsplash.com/premium_photo-1708692920701-19a470ecd667?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .padel-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 32%),
                linear-gradient(to top, rgba(15, 23, 42, 0.75), transparent 55%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.65rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(10px);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: clamp(2.4rem, 6vw, 5rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.05em;
            margin-bottom: 1.3rem;
        }

        .hero-title span {
            color: #bbf7d0;
        }

        .hero-desc {
            max-width: 650px;
            font-size: 1.15rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 2rem;
        }

        .btn-padel {
            background: linear-gradient(135deg, var(--padel-primary), var(--padel-accent));
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 0.85rem 1.6rem;
            font-weight: 800;
            box-shadow: 0 14px 30px rgba(22, 163, 74, 0.35);
            transition: 0.25s ease;
        }

        .btn-padel:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(22, 163, 74, 0.45);
        }

        .btn-ghost-light {
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #fff;
            border-radius: 999px;
            padding: 0.85rem 1.6rem;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .btn-ghost-light:hover {
            background: #fff;
            color: var(--padel-primary);
        }

        .hero-stat-card {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 1.1rem;
        }

        .hero-stat-card small {
            color: rgba(255, 255, 255, 0.78);
        }

        .section-label {
            color: var(--padel-primary);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.85rem;
        }

        .section-title {
            color: var(--padel-dark);
            font-weight: 900;
            letter-spacing: -0.03em;
        }

        .section-desc {
            color: var(--padel-muted);
            max-width: 700px;
            margin: 0 auto;
        }

        .booking-section {
            background: linear-gradient(180deg, #f8fafc, #ffffff);
            padding: 5rem 0;
        }

        .court-card {
            height: 100%;
            border: none;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.09);
            transition: 0.25s ease;
        }

        .court-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.14);
        }

        .court-image {
            position: relative;
            height: 235px;
            overflow: hidden;
        }

        .court-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.35s ease;
        }

        .court-card:hover .court-image img {
            transform: scale(1.07);
        }

        .court-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(22, 163, 74, 0.92);
            color: #fff;
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 800;
        }

        .court-body {
            padding: 1.4rem;
        }

        .court-title {
            color: var(--padel-dark);
            font-weight: 900;
            margin-bottom: 0.35rem;
        }

        .court-meta {
            color: var(--padel-muted);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .price {
            font-size: 1.35rem;
            color: var(--padel-primary);
            font-weight: 900;
            margin-bottom: 1.2rem;
        }

        .price span {
            color: var(--padel-muted);
            font-size: 0.95rem;
            font-weight: 600;
        }

        .feature-section {
            background: #fff;
            padding: 5rem 0;
        }

        .feature-card {
            height: 100%;
            padding: 1.6rem;
            border-radius: 22px;
            background: #fff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            transition: 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(22, 163, 74, 0.35);
        }

        .feature-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--padel-soft);
            color: var(--padel-primary);
            font-size: 1.35rem;
            margin-bottom: 1.2rem;
        }

        .how-section {
            background: var(--padel-soft);
            padding: 5rem 0;
        }

        .step-card {
            height: 100%;
            padding: 1.6rem;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
        }

        .step-number {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--padel-primary);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .faq-section {
            background: #fff;
            padding: 5rem 0;
        }

        .accordion-item {
            border: 1px solid #e5e7eb;
            border-radius: 14px !important;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
        }

        .accordion-button {
            font-weight: 800;
        }

        .accordion-button:not(.collapsed) {
            background: var(--padel-soft);
            color: var(--padel-primary);
        }

        .cta-section {
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(22, 163, 74, 0.86)),
                url('https://plus.unsplash.com/premium_photo-1708692920701-19a470ecd667?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 5rem 0;
        }

        @media (max-width: 768px) {
            .padel-hero {
                min-height: auto;
                padding: 5rem 0;
            }

            .hero-desc {
                font-size: 1rem;
            }

            .court-image {
                height: 210px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="padel-hero">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-badge">
                        <i class="fas fa-table-tennis-paddle-ball"></i>
                        Padel Court Booking
                    </div>

                    <h1 class="hero-title">
                        Booking Lapangan <span>Padel</span> Jadi Lebih Mudah
                    </h1>

                    <p class="hero-desc">
                        Pilih lapangan padel favorit, cek jadwal yang tersedia, dan lakukan pembayaran
                        secara praktis dalam satu sistem booking online.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#lapangan" class="btn btn-padel">
                            <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
                        </a>

                        <a href="#tentang" class="btn btn-ghost-light">
                            Lihat Keunggulan
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-5">
                <div class="col-md-4">
                    <div class="hero-stat-card">
                        <h4 class="fw-bold mb-1">Real-time</h4>
                        <small>Cek ketersediaan jadwal langsung dari sistem.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="hero-stat-card">
                        <h4 class="fw-bold mb-1">Mudah</h4>
                        <small>Booking lapangan tanpa antre dan tanpa telepon.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="hero-stat-card">
                        <h4 class="fw-bold mb-1">Aman</h4>
                        <small>Pembayaran online dengan status booking yang jelas.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="booking-section" id="lapangan">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label mb-2">Padel Court</div>
                <h2 class="section-title display-6 mb-3">Pilih Lapangan Padel Favoritmu</h2>
                <p class="section-desc fs-5">
                    Temukan lapangan yang sesuai, pilih jadwal bermain, lalu selesaikan pembayaran dengan cepat.
                </p>
            </div>

            <div class="row g-4">
                @forelse ($courts as $court)
                    <div class="col-lg-4 col-md-6">
                        <a class="text-decoration-none" href="/court-detail/{{ $court->id }}">
                            <div class="court-card">
                                <div class="court-image">
                                    <img src="{{ Str::substr($court->image_url, 0, 12) === 'court_images' ? '/storage/' . $court->image_url : $court->image_url }}"
                                        alt="Lapangan padel modern">

                                    <div class="court-badge">
                                        <i class="fas fa-bolt me-1"></i> Available
                                    </div>
                                </div>

                                <div class="court-body">
                                    <h3 class="court-title">{{ $court->name }}</h3>

                                    <div class="court-meta">
                                        <i class="fas fa-location-dot me-1"></i>
                                        Lapangan padel siap booking
                                    </div>

                                    <div class="price">
                                        Rp{{ number_format($court->price, 0, ',', '.') }}
                                        <span>/3 jam</span>
                                    </div>

                                    <button class="btn btn-padel w-100">
                                        <i class="fas fa-calendar-check me-2"></i>Book Sekarang
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center bg-white rounded-4 p-5 shadow-sm">
                            <i class="fas fa-table-tennis-paddle-ball fs-1 text-success mb-3"></i>
                            <h4 class="fw-bold">Belum Ada Lapangan</h4>
                            <p class="text-muted mb-0">Data lapangan padel belum tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section" id="tentang">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label mb-2">Keunggulan</div>
                <h2 class="section-title display-6 mb-3">Kenapa Booking di PadelGo?</h2>
                <p class="section-desc fs-5">
                    Kami membantu proses booking lapangan padel menjadi lebih cepat, jelas, dan nyaman.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="fw-bold">Booking 24 Jam</h5>
                        <p class="text-muted mb-0">
                            Sistem online memudahkan booking kapan saja tanpa perlu datang langsung.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h5 class="fw-bold">Jadwal Real-time</h5>
                        <p class="text-muted mb-0">
                            Jam yang sudah dibooking langsung terkunci agar tidak bentrok.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5 class="fw-bold">Pembayaran Mudah</h5>
                        <p class="text-muted mb-0">
                            Selesaikan pembayaran online dengan status yang bisa dipantau.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h5 class="fw-bold">Riwayat Booking</h5>
                        <p class="text-muted mb-0">
                            Semua riwayat booking dan status pembayaran tersimpan di akun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How To Book Section -->
    <section class="how-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label mb-2">Cara Booking</div>
                <h2 class="section-title display-6 mb-3">Booking Padel Hanya 3 Langkah</h2>
                <p class="section-desc fs-5">
                    Proses sederhana agar kamu bisa langsung fokus untuk bermain.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h5 class="fw-bold">Pilih Lapangan</h5>
                        <p class="text-muted mb-0">
                            Pilih lapangan padel yang tersedia dari daftar lapangan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h5 class="fw-bold">Pilih Tanggal & Jam</h5>
                        <p class="text-muted mb-0">
                            Tentukan jadwal bermain sesuai ketersediaan waktu.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h5 class="fw-bold">Bayar & Main</h5>
                        <p class="text-muted mb-0">
                            Selesaikan pembayaran, lalu datang sesuai jadwal booking.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label mb-2">FAQ</div>
                <h2 class="section-title display-6 mb-3">Pertanyaan yang Sering Diajukan</h2>
                <p class="section-desc fs-5">
                    Jawaban singkat seputar booking lapangan padel di PadelGo.
                </p>
            </div>

            <div class="accordion accordion-flush mx-auto" id="faqAccordion" style="max-width: 850px;">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne">
                            Bagaimana cara memesan lapangan padel?
                        </button>
                    </h2>

                    <div id="faqCollapseOne" class="accordion-collapse collapse" aria-labelledby="faqHeadingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Login ke akun Anda, pilih lapangan, pilih tanggal dan jam yang tersedia,
                            lalu lanjutkan ke pembayaran.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            Apakah jadwal yang sudah dibooking bisa dipilih lagi?
                        </button>
                    </h2>

                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Tidak. Jadwal yang sudah dibooking akan otomatis terkunci agar tidak terjadi bentrok.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseThree" aria-expanded="false"
                            aria-controls="faqCollapseThree">
                            Bagaimana jika pembayaran belum diselesaikan?
                        </button>
                    </h2>

                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Booking akan berstatus menunggu pembayaran. Jika melewati batas waktu pembayaran,
                            booking dapat otomatis gagal dan jadwal kembali tersedia.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="fw-bold display-6 mb-3">
                Siap Main Padel Hari Ini?
            </h2>

            <p class="fs-5 text-white-50 mx-auto mb-4" style="max-width: 680px;">
                Pilih lapangan padel favoritmu sekarang dan nikmati proses booking yang cepat,
                praktis, dan nyaman.
            </p>

            <a href="#lapangan" class="btn btn-light btn-lg px-5 text-success fw-bold rounded-pill">
                <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
            </a>
        </div>
    </section>
</x-landing-layout>
