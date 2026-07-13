<style>
    .padel-footer {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at top left, rgba(34, 197, 94, 0.22), transparent 32%),
            linear-gradient(135deg, #0f172a, #111827 55%, #052e16);
        color: #e5e7eb;
        padding-top: 80px;
    }

    .padel-footer::before {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        right: -120px;
        top: -120px;
        background: rgba(34, 197, 94, 0.16);
        border-radius: 50%;
        filter: blur(4px);
    }

    .padel-footer::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        left: -90px;
        bottom: -90px;
        background: rgba(22, 163, 74, 0.14);
        border-radius: 50%;
        filter: blur(4px);
    }

    .footer-content {
        position: relative;
        z-index: 2;
    }

    .footer-logo {
        height: 48px;
        max-width: 180px;
        object-fit: contain;
        margin-bottom: 18px;
    }

    .footer-brand-title {
        font-weight: 900;
        font-size: 1.5rem;
        color: #ffffff;
        margin-bottom: 12px;
    }

    .footer-desc {
        color: #cbd5e1;
        line-height: 1.8;
        max-width: 360px;
        margin-bottom: 22px;
    }

    .footer-social a {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.16);
        text-decoration: none;
        margin-right: 10px;
        transition: 0.25s ease;
    }

    .footer-social a:hover {
        background: #22c55e;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(34, 197, 94, 0.28);
    }

    .footer-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 18px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 11px;
    }

    .footer-links a {
        color: #cbd5e1;
        text-decoration: none;
        transition: 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .footer-links a:hover {
        color: #86efac;
        transform: translateX(4px);
    }

    .footer-contact li {
        display: flex;
        gap: 12px;
        color: #cbd5e1;
        margin-bottom: 14px;
        line-height: 1.6;
    }

    .footer-contact i {
        color: #22c55e;
        margin-top: 4px;
        width: 18px;
    }

    .footer-highlight {
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 18px;
        padding: 18px;
        color: #ffffff;
    }

    .footer-highlight .badge {
        background: rgba(34, 197, 94, 0.18);
        color: #bbf7d0;
        border: 1px solid rgba(187, 247, 208, 0.24);
        padding: 8px 12px;
        border-radius: 999px;
        margin-bottom: 12px;
    }

    .footer-bottom {
        position: relative;
        z-index: 2;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
        margin-top: 50px;
        padding: 22px 0;
        color: #94a3b8;
    }

    .footer-bottom a {
        color: #cbd5e1;
        text-decoration: none;
        margin-left: 18px;
    }

    .footer-bottom a:hover {
        color: #86efac;
    }

    @media (max-width: 768px) {
        .padel-footer {
            padding-top: 55px;
        }

        .footer-bottom {
            text-align: center;
        }

        .footer-bottom a {
            display: inline-block;
            margin: 8px 8px 0;
        }
    }
</style>

<footer class="padel-footer">
    <div class="container footer-content">
        <div class="row g-5">
            <div class="col-lg-4">
                <img src="https://cdn.phototourl.com/member/2026-06-28-11d6d025-ff8d-4b69-8cf1-247129df545c.png"
                    alt="PadelGo Logo" class="footer-logo">

                <div class="footer-brand-title">PadelGo.</div>

                <p class="footer-desc">
                    Sistem booking lapangan padel online yang praktis, modern, dan mudah digunakan
                    untuk membantu Anda bermain tanpa ribet.
                </p>

                <div class="footer-social">
                    <a href="#" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Navigasi</h6>
                <ul class="footer-links">
                    <li>
                        <a href="/">
                            <i class="fas fa-chevron-right small"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="#lapangan">
                            <i class="fas fa-chevron-right small"></i> Lapangan
                        </a>
                    </li>
                    <li>
                        <a href="#tentang">
                            <i class="fas fa-chevron-right small"></i> Keunggulan
                        </a>
                    </li>
                    <li>
                        <a href="#faqAccordion">
                            <i class="fas fa-chevron-right small"></i> FAQ
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Bantuan</h6>
                <ul class="footer-links">
                    <li>
                        <a href="#lapangan">
                            <i class="fas fa-chevron-right small"></i> Cara Booking
                        </a>
                    </li>
                    <li>
                        <a href="/sign-in">
                            <i class="fas fa-chevron-right small"></i> Masuk Akun
                        </a>
                    </li>
                    <li>
                        <a href="/sign-up">
                            <i class="fas fa-chevron-right small"></i> Daftar Akun
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-right small"></i> Pembayaran
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6 class="footer-title">Kontak & Operasional</h6>

                <ul class="list-unstyled footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Padel No. 10, Jakarta, Indonesia</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>(021) 12345678</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>info@padelgo.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Senin - Minggu, 08.00 - 22.00 WIB</span>
                    </li>
                </ul>

                <div class="footer-highlight mt-4">
                    <div class="badge">
                        <i class="fas fa-bolt me-1"></i> Booking Online
                    </div>

                    <h6 class="fw-bold mb-2">Siap main padel hari ini?</h6>
                    <p class="mb-3 text-light opacity-75">
                        Pilih lapangan favorit dan lakukan booking sekarang.
                    </p>

                    <a href="#lapangan" class="btn btn-success rounded-pill px-4 fw-bold">
                        <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    &copy; {{ date('Y') }} PadelGo. All rights reserved.
                </div>

                <div>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>
