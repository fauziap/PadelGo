<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use App\Jobs\ProcessWelcomeMail;
use App\Mail\WelcomeMail;
use App\Models\Book;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    $courts = Court::all();

    return view('welcome', [
        'courts' => $courts,
    ]);
});

Route::get('/court-detail/{court}', function (Court $court, Request $request) {
    $selectedDate = $request->input('date', date('Y-m-d'));

    Book::where('payment_status', 'pending')
        ->where('created_at', '<=', now()->subMinutes(10))
        ->update(['payment_status' => 'failed']);

    $schedules = Schedule::all();

    $books = Book::where('court_id', $court->id)
        ->whereDate('booking_date', $selectedDate)
        ->whereIn('payment_status', ['success', 'pending', 'challenge'])
        ->get();

    $bookedScheduleIds = $books->pluck('schedule_id')->toArray();

    return view('detail-court', compact(
        'court',
        'schedules',
        'books',
        'selectedDate',
        'bookedScheduleIds'
    ));
});

Route::post('/sign-up', [AuthController::class, 'register']);

Route::post('/sign-in', [AuthController::class, 'login']);


Route::middleware(['guest'])->group(function () {

    Route::get('/sign-up', function () {
        return view('register');
    });

    Route::get('/sign-in', function () {
        return view('login');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/dashboard/schedules', ScheduleController::class);

    Route::resource('/dashboard/courts', CourtController::class);

    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/booking-history', function () {
        Book::where('user_id', Auth::id())
            ->where('payment_status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(10))
            ->update(['payment_status' => 'failed']);

        $pendingBooks = Book::where('user_id', Auth::id())
            ->where('payment_status', 'pending')
            ->get();

        if ($pendingBooks->isNotEmpty()) {
            \Midtrans\Config::$serverKey = config('midtrans.serverKey') ?? config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction') ?? config('midtrans.is_production');

            foreach ($pendingBooks as $book) {
                try {
                    $status = \Midtrans\Transaction::status($book->order_id);
                    $transactionStatus = $status->transaction_status;
                    
                    if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                        $book->payment_status = 'success';
                        $book->save();
                    } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
                        $book->payment_status = 'failed';
                        $book->save();
                    }
                } catch (\Exception $e) {
                    // Ignore exception (e.g., transaction not found)
                }
            }
        }

        $books = Book::with(['court', 'schedule', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.booking-history', ['books' => $books]);
    });

    Route::get('/dashboard/books/export', [BookController::class, 'export']);
    Route::resource('/dashboard/books', BookController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/update/profile/{user}', [AuthController::class, 'update']);

    Route::get('/payment-confirmation/book/{book}', function (Book $book) {
        if ($book->user->id !== Auth::user()->id) {
            abort(404);
        }

        if (
            $book->payment_status === 'pending' &&
            $book->created_at->copy()->addMinutes(10)->isPast()
        ) {
            $book->update([
                'payment_status' => 'failed',
            ]);

            return redirect('/dashboard/booking-history')
                ->with('error', 'Waktu pembayaran habis. Booking dibatalkan.');
        }

        return view('payment-confirmation', ['book' => $book]);
    });
});

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect()->intended('/dashboard/booking-history');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
