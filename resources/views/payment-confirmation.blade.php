@php
    use Illuminate\Support\Str;

    $imageUrl = Str::startsWith($book->court->image_url, 'court_images')
        ? asset('storage/' . $book->court->image_url)
        : $book->court->image_url;

    $expiresAt = $book->created_at->copy()->addMinutes(10)->timestamp * 1000;
@endphp

<x-landing-layout>
    <div class="container payment-container">
        <div class="card payment-card">
            <div class="card-header text-center">
                <i class="fas fa-check-circle payment-icon"></i>
                <h2>Konfirmasi Pembayaran</h2>

                <div class="payment-status">
                    Menunggu Pembayaran
                </div>

                <div class="mt-3">
                    <strong>Sisa waktu pembayaran:</strong>
                    <div id="countdown" class="text-danger fs-4 fw-bold">10:00</div>
                </div>
            </div>

            <div class="card-body payment-details">
                <h5 class="mb-4">Detail Pesanan</h5>

                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $imageUrl }}" class="product-image">
                    <div class="product-info">
                        <h5>{{ $book->court->name }}</h5>
                        <small class="text-success">
                            <i class="fas fa-check-circle me-1"></i> Lapangan tersedia
                        </small>
                    </div>
                </div>

                <div class="detail-row total-row">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($book->court->price, 0, ',', '.') }}</span>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-confirm" id="pay-button" data-snap-token="{{ $book->snap_token }}">
                        Bayar Sekarang
                    </button>
                </div>

                <form action="/dashboard/books/{{ $book->id }}" method="post" class="text-center mt-3" id="cancel-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger bg-body border-0 text-center">
                        Batalkan
                    </button>
                </form>

                <p class="text-center text-muted mt-4 small">
                    <i class="fas fa-info-circle me-1"></i>
                    Pembayaran harus diselesaikan dalam waktu 10 menit. Jika tidak, pesanan otomatis dibatalkan.
                </p>
            </div>
        </div>
    </div>
</x-landing-layout>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    const expiresAt = {{ $expiresAt }};
    const countdownElement = document.getElementById('countdown');
    const payButton = document.getElementById('pay-button');

    const timer = setInterval(function () {
        const now = new Date().getTime();
        const distance = expiresAt - now;

        if (distance <= 0) {
            clearInterval(timer);

            countdownElement.innerHTML = "00:00";
            payButton.disabled = true;
            payButton.innerHTML = "Waktu Pembayaran Habis";

            alert("Waktu pembayaran habis. Pesanan akan dibatalkan.");

            document.getElementById('cancel-form').submit();
            return;
        }

        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownElement.innerHTML =
            String(minutes).padStart(2, '0') + ":" + String(seconds).padStart(2, '0');
    }, 1000);

    document.getElementById('pay-button').onclick = function() {
        const snapToken = this.getAttribute('data-snap-token');

        snap.pay(snapToken, {
            onSuccess: function(result) {
                window.location.href = "/dashboard/booking-history";
            },
            onPending: function(result) {
                alert("Transaksi sedang diproses. Silakan selesaikan pembayaran sebelum waktu habis.");
            },
            onError: function(result) {
                alert("Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi atau gunakan metode pembayaran lain.");
            },
            onClose: function() {
                alert("Kamu menutup halaman pembayaran. Selesaikan pembayaran sebelum waktu habis.");
            }
        });
    };
</script>
