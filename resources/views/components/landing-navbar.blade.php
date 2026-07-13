@php
    use Illuminate\Support\Str;

    $user = auth()->user();

    if ($user) {
        $profileImage = $user->profile_image_url;

        if ($profileImage) {
            if (Str::startsWith($profileImage, 'user_photos')) {
                $imgSrc = '/storage/' . $profileImage;
            } elseif (Str::startsWith($profileImage, ['http://', 'https://'])) {
                $imgSrc = $profileImage;
            } else {
                $imgSrc = asset($profileImage);
            }
        } else {
            $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            $imgSrc = 'https://ui-avatars.com/api/?name=' . urlencode($fullName ?: 'User') . '&background=16a34a&color=ffffff';
        }
    }
@endphp

<style>
    .padel-navbar {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(14px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        padding: 0.85rem 0;
        z-index: 1030;
    }

    .padel-brand {
        text-decoration: none;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.03em;
        font-size: 1.35rem;
    }

    .padel-brand:hover {
        color: #16a34a;
    }

    .padel-brand-logo {
        height: 40px;
        max-width: 150px;
        object-fit: contain;
    }

    .brand-dot {
        color: #16a34a;
    }

    .padel-nav-link {
        position: relative;
        color: #334155 !important;
        font-weight: 700;
        padding: 0.65rem 0.9rem !important;
        border-radius: 999px;
        transition: 0.25s ease;
    }

    .padel-nav-link:hover {
        color: #16a34a !important;
        background: #ecfdf5;
    }

    .padel-nav-link.active {
        color: #16a34a !important;
        background: #ecfdf5;
    }

    .login-btn {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: #fff !important;
        border-radius: 999px;
        padding: 0.65rem 1.25rem !important;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(22, 163, 74, 0.25);
        transition: 0.25s ease;
        border: none;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(22, 163, 74, 0.34);
        color: #fff !important;
    }

    .user-menu-btn {
        border: 1px solid #e2e8f0;
        background: #ffffff;
        border-radius: 999px;
        padding: 0.35rem 0.75rem 0.35rem 0.35rem !important;
        color: #0f172a !important;
        font-weight: 800;
        transition: 0.25s ease;
    }

    .user-menu-btn:hover {
        border-color: rgba(22, 163, 74, 0.35);
        background: #ecfdf5;
        color: #16a34a !important;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #bbf7d0;
    }

    .padel-dropdown {
        border: none;
        border-radius: 18px;
        padding: 0.65rem;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        min-width: 235px;
        margin-top: 0.75rem !important;
    }

    .dropdown-user-info {
        padding: 0.75rem;
        border-radius: 14px;
        background: #ecfdf5;
        margin-bottom: 0.5rem;
    }

    .dropdown-user-info .name {
        font-weight: 900;
        color: #0f172a;
        line-height: 1.2;
    }

    .dropdown-user-info .email {
        font-size: 0.82rem;
        color: #64748b;
        word-break: break-word;
    }

    .padel-dropdown .dropdown-item {
        border-radius: 12px;
        padding: 0.7rem 0.85rem;
        font-weight: 700;
        color: #334155;
        transition: 0.2s ease;
    }

    .padel-dropdown .dropdown-item:hover {
        background: #ecfdf5;
        color: #16a34a;
    }

    .dropdown-item.logout-item {
        color: #dc2626;
    }

    .dropdown-item.logout-item:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    .custom-toggler {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.55rem 0.7rem;
        box-shadow: none !important;
    }

    .custom-toggler:focus {
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.15) !important;
    }

    @media (max-width: 768px) {
        .navbar-collapse {
            margin-top: 1rem;
            background: #ffffff;
            border-radius: 18px;
            padding: 1rem;
            box-shadow: 0 16px 35px rgba(15, 23, 42, 0.08);
        }

        .padel-nav-link,
        .login-btn {
            width: 100%;
            text-align: left;
        }

        .user-menu-btn {
            width: 100%;
            justify-content: flex-start;
        }

        .padel-dropdown {
            box-shadow: none;
            border: 1px solid #e2e8f0;
            margin-top: 0.5rem !important;
        }
    }
</style>

<nav class="navbar navbar-expand-md sticky-top padel-navbar">
    <div class="container">
        <!-- Logo dan Brand -->
        <a class="navbar-brand padel-brand d-flex align-items-center gap-2" href="/">
            <img src="https://cdn.phototourl.com/member/2026-06-28-11d6d025-ff8d-4b69-8cf1-247129df545c.png"
                alt="PadelGo Logo" class="padel-brand-logo">

            <span class="d-none d-sm-inline">
                PadelGo<span class="brand-dot">.</span>
            </span>
        </a>

        <!-- Burger menu -->
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-md-center gap-md-2">
                <li class="nav-item">
                    <a class="nav-link padel-nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link padel-nav-link" href="/#lapangan">
                        <i class="fas fa-table-tennis-paddle-ball me-1"></i> Lapangan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link padel-nav-link" href="/#tentang">
                        <i class="fas fa-circle-info me-1"></i> Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link padel-nav-link" href="/#faqAccordion">
                        <i class="fas fa-question-circle me-1"></i> FAQ
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown ms-md-2">
                        <a class="nav-link dropdown-toggle user-menu-btn d-flex align-items-center gap-2"
                            href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ $imgSrc }}" class="user-avatar" alt="Foto profil pengguna">

                            <span class="d-none d-md-inline">
                                Hi, {{ auth()->user()->first_name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end padel-dropdown" aria-labelledby="userDropdown">
                            <li>
                                <div class="dropdown-user-info">
                                    <div class="name">
                                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name ?? '' }}
                                    </div>
                                    <div class="email">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/dashboard">
                                    <i class="fas fa-gauge-high me-2"></i>Dashboard
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/dashboard/booking-history">
                                    <i class="fas fa-calendar-check me-2"></i>Booking Saya
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="/logout" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-item">
                                        <i class="fas fa-right-from-bracket me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-md-2">
                        <a class="nav-link login-btn" href="/sign-in">
                            <i class="fas fa-right-to-bracket me-2"></i>Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
