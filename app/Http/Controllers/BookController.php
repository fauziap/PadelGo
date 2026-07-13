<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
{
    // Booking pending lebih dari 10 menit otomatis failed
    Book::where('payment_status', 'pending')
        ->where('created_at', '<=', now()->subMinutes(10))
        ->update(['payment_status' => 'failed']);

    $books = $this->filteredBooks($request, true)
        ->paginate(5)
        ->withQueryString();

    // Statistik mengikuti filter keyword dan range tanggal,
    // tapi tidak ikut filter status agar total status tetap kelihatan lengkap
    $summaryQuery = $this->filteredBooks($request, false);

    $totalBookings = (clone $summaryQuery)->count();
    $totalConfirmedBookings = (clone $summaryQuery)->where('payment_status', 'success')->count();
    $totalPendingBookings = (clone $summaryQuery)->where('payment_status', 'pending')->count();
    $totalChallengeBookings = (clone $summaryQuery)->where('payment_status', 'challenge')->count();

    return view('dashboard.books', compact(
        'totalBookings',
        'totalConfirmedBookings',
        'totalPendingBookings',
        'totalChallengeBookings',
        'books'
    ));
}

private function filteredBooks(Request $request, bool $withStatus = true)
{
    $query = Book::with(['court', 'user', 'schedule'])->latest();

    if ($request->filled('keyword')) {
        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {
            $q->whereHas('user', function ($userQuery) use ($keyword) {
                $userQuery->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            })
            ->orWhereHas('court', function ($courtQuery) use ($keyword) {
                $courtQuery->where('name', 'like', '%' . $keyword . '%');
            })
            ->orWhere('phone_number', 'like', '%' . $keyword . '%');
        });
    }

    // Filter range tanggal: dari tanggal
    if ($request->filled('date_from')) {
        $query->whereDate('booking_date', '>=', $request->date_from);
    }

    // Filter range tanggal: sampai tanggal
    if ($request->filled('date_to')) {
        $query->whereDate('booking_date', '<=', $request->date_to);
    }

    if ($withStatus && $request->filled('status')) {
        $query->where('payment_status', $request->status);
    }

    return $query;
}

public function export(Request $request)
{
    // Booking pending lebih dari 10 menit otomatis failed
    Book::where('payment_status', 'pending')
        ->where('created_at', '<=', now()->subMinutes(10))
        ->update(['payment_status' => 'failed']);

    $books = $this->filteredBooks($request, true)->get();

    $fileName = 'laporan-booking-lapangan-padel-' . now()->format('Y-m-d-H-i-s') . '.xls';

    $headers = [
        'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        'Cache-Control' => 'max-age=0',
    ];

    return response()->stream(function () use ($books, $request) {
        echo "\xEF\xBB\xBF";

        echo '<table border="1">';
        echo '<tr>';
        echo '<th colspan="9" style="font-size:18px;">Laporan Booking Lapangan Padel</th>';
        echo '</tr>';

        echo '<tr>';
        echo '<td colspan="9">';
        echo 'Tanggal Export: ' . now()->format('d-m-Y H:i:s') . '<br>';
        echo 'Dari Tanggal: ' . ($request->date_from ?: 'Semua') . '<br>';
        echo 'Sampai Tanggal: ' . ($request->date_to ?: 'Semua') . '<br>';
        echo 'Filter Status: ' . ($request->status ?: 'Semua Status') . '<br>';
        echo 'Keyword: ' . ($request->keyword ?: '-') . '<br>';
        echo '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Court</th>';
        echo '<th>Customer</th>';
        echo '<th>Email</th>';
        echo '<th>Phone Number</th>';
        echo '<th>Booking Date</th>';
        echo '<th>Time Slot</th>';
        echo '<th>Price</th>';
        echo '<th>Status</th>';
        echo '</tr>';

        foreach ($books as $index => $book) {
            $customerName = trim(($book->user->first_name ?? '') . ' ' . ($book->user->last_name ?? ''));

            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . e($book->court->name ?? '-') . '</td>';
            echo '<td>' . e($customerName ?: '-') . '</td>';
            echo '<td>' . e($book->user->email ?? '-') . '</td>';
            echo '<td>' . e($book->phone_number ?? '-') . '</td>';
            echo '<td>' . e(\Carbon\Carbon::parse($book->booking_date)->format('d-m-Y')) . '</td>';
            echo '<td>' . e(($book->schedule->start_time ?? '-') . ' - ' . ($book->schedule->end_time ?? '-')) . '</td>';
            echo '<td>Rp ' . number_format($book->court->price ?? 0, 0, ',', '.') . '</td>';
            echo '<td>' . e(ucfirst($book->payment_status)) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }, 200, $headers);
}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Booking pending lebih dari 10 menit dianggap gagal
        Book::where('payment_status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(10))
            ->update(['payment_status' => 'failed']);

        $validated = $request->validate([
            'phone_number' => [
                'required',
                'regex:/^(08|\+628)[0-9]{7,11}$/'
            ],
            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'schedule_id' => [
                'required',
                'exists:schedules,id'
            ],
            'court_id' => [
                'required',
                'exists:courts,id'
            ],
        ], [
            'schedule_id.required' => 'Please select a valid time slot.',
            'schedule_id.exists' => 'The selected time slot is invalid.',
            'court_id.required' => 'Lapangan tidak ditemukan.',
            'court_id.exists' => 'Lapangan tidak valid.',
        ]);

        // Cek apakah jam sudah dibooking orang lain
        $alreadyBooked = Book::where('court_id', $validated['court_id'])
            ->whereDate('booking_date', $validated['booking_date'])
            ->where('schedule_id', $validated['schedule_id'])
            ->whereIn('payment_status', ['success', 'pending', 'challenge'])
            ->exists();

        if ($alreadyBooked) {
            return back()
                ->withInput()
                ->withErrors([
                    'schedule_id' => 'Jadwal ini sudah dibooking. Silakan pilih jam lain.'
                ]);
        }

        $validated['user_id'] = Auth::id();
        $validated['payment_status'] = 'pending';

        $book = Book::create($validated);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey') ?? config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction') ?? config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized') ?? config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds') ?? config('midtrans.is_3ds');

        \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/api/midtrans-callback';

        $orderId = 'ORDER-' . $book->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $book->court->price,
            ],

            'customer_details' => [
                'first_name' => Auth::user()->first_name ?? 'Customer',
                'last_name' => Auth::user()->last_name ?? '',
                'email' => Auth::user()->email,
                'phone' => $book->phone_number,
            ],

            'item_details' => [
                [
                    'id' => 'court-' . $book->court->id,
                    'price' => (int) $book->court->price,
                    'quantity' => 1,
                    'name' => $book->court->name,
                ]
            ],

            // Expired pembayaran Midtrans dalam 10 menit
            'expiry' => [
                'start_time' => now()->format('Y-m-d H:i:s O'),
                'unit' => 'minute',
                'duration' => 10,
            ],

            'callbacks' => [
                'finish' => config('app.url') . '/dashboard/booking-history',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $book->update([
            'snap_token' => $snapToken,
            'order_id' => $orderId,
            'payment_status' => 'pending',
        ]);

        return redirect('/payment-confirmation/book/' . $book->id);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Book $book)
    {
        if ($book->user->id !== Auth::user()->id) {
            abort(404);
        }

        $book->update([
            'payment_status' => 'failed',
        ]);

        return redirect('/dashboard/booking-history')
            ->with('error', 'Booking dibatalkan.');
    }
}
