<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - PadelGo</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #16a34a;
            --primary-hover: #15803d;
            --secondary-color: #f8fafc;
            --dark-color: #1e293b;
            --light-color: #f1f5f9;
            --text-color: #64748b;
            --accent-color: #22c55e;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #ecfdf5, #f8fafc);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-container {
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
            border-radius: 18px;
            overflow: hidden;
            background-color: white;
        }

        .register-left {
            background:
                linear-gradient(135deg, rgba(22, 163, 74, 0.92), rgba(21, 128, 61, 0.92)),
                url('https://plus.unsplash.com/premium_photo-1708692920701-19a470ecd667?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .register-left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 35%);
            pointer-events: none;
        }

        .register-left-content {
            position: relative;
            z-index: 2;
        }

        .register-left h2 {
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .register-left p {
            opacity: 0.95;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            margin-bottom: 1rem;
            padding-left: 2rem;
            position: relative;
            font-weight: 500;
        }

        .feature-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            color: #bbf7d0;
        }

        .padel-preview-card {
            position: relative;
            z-index: 2;
            margin-top: 3rem;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 18px;
            padding: 1rem;
        }

        .padel-preview-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            border-radius: 14px;
        }

        .padel-preview-caption {
            margin-top: 0.9rem;
            font-size: 0.95rem;
            opacity: 0.95;
        }

        .register-right {
            padding: 3rem;
        }

        .logo {
            font-weight: 900;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo i {
            color: var(--accent-color);
        }

        .form-title {
            font-weight: 800;
            font-size: 1.9rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .form-subtitle {
            color: var(--text-color);
            margin-bottom: 2rem;
        }

        .form-floating label {
            color: var(--text-color);
        }

        .form-control {
            padding: 1rem 1rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.15);
            border-color: var(--primary-color);
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-color);
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-btn {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            color: var(--dark-color);
            text-decoration: none;
            background-color: #ffffff;
        }

        .social-btn:hover {
            background-color: var(--light-color);
            transform: translateY(-2px);
        }

        .social-btn i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-color);
        }

        .login-link a {
            color: var(--primary-color);
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover {
            color: var(--primary-hover);
        }

        @media (max-width: 992px) {
            .register-left {
                display: none !important;
            }

            .register-right {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row register-container">
            <!-- Left Side -->
            <div class="col-lg-6 register-left d-none d-lg-flex">
                <div class="register-left-content">
                    <h2>Mulai Booking Lapangan Padel Lebih Praktis</h2>
                    <p>
                        Buat akun untuk memilih jadwal, memesan lapangan padel,
                        dan melihat status pembayaran Anda dengan lebih mudah.
                    </p>

                    <ul class="feature-list">
                        <li>Booking lapangan padel tanpa antre</li>
                        <li>Pilih tanggal dan jam bermain secara real-time</li>
                        <li>Simpan riwayat dan bukti pemesanan</li>
                        <li>Kelola jadwal main padel kapan saja</li>
                    </ul>
                </div>

                <div class="padel-preview-card">
                    <img src="https://plus.unsplash.com/premium_photo-1708692920701-19a470ecd667?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Lapangan padel modern">

                    <div class="padel-preview-caption">
                        <i class="fas fa-table-tennis-paddle-ball me-2"></i>
                        Daftar sekarang dan nikmati pengalaman booking lapangan padel yang lebih cepat.
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-6 register-right">
                <a class="logo" href="/">
                    <i class="fas fa-table-tennis-paddle-ball"></i>
                    PadelGo<span style="color: var(--primary-hover);">.</span>
                </a>

                <h1 class="form-title">Buat Akun Baru</h1>
                <p class="form-subtitle">
                    Isi data berikut untuk mulai booking lapangan padel favorit Anda.
                </p>

                <form id="registerForm" method="POST" action="/sign-up">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="firstName" placeholder="Nama Depan" name="first_name"
                                    value="{{ old('first_name') }}">
                                <label for="firstName">Nama Depan</label>

                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="lastName" placeholder="Nama Belakang" name="last_name"
                                    value="{{ old('last_name') }}">
                                <label for="lastName">Nama Belakang</label>

                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Alamat Email" name="email"
                                    value="{{ old('email') }}">
                                <label for="email">Alamat Email</label>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Buat Password" name="password">
                                <label for="password">Password</label>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-text text-muted">
                                    Gunakan setidaknya 8 karakter dengan kombinasi huruf dan angka.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="confirmPassword" placeholder="Konfirmasi Password"
                                    name="password_confirmation">
                                <label for="confirmPassword">Konfirmasi Password</label>

                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </form>

                <div class="divider">atau daftar dengan</div>

                <a class="social-btn w-100" href="/auth/google/redirect">
                    <i class="fab fa-google text-danger"></i> Lanjutkan dengan Google
                </a>

                <div class="login-link">
                    Sudah punya akun? <a href="/sign-in">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
