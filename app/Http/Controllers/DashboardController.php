<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Court;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Pending lebih dari 10 menit otomatis failed
        Book::where('payment_status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(10))
            ->update(['payment_status' => 'failed']);

        $now = Carbon::now();

        $dateFrom = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->startOfDay()
            : $now->copy()->subDays(6)->startOfDay();

        $dateTo = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->endOfDay()
            : $now->copy()->endOfDay();

        // Kalau tanggal awal lebih besar dari tanggal akhir, otomatis ditukar
        if ($dateFrom->greaterThan($dateTo)) {
            $temp = $dateFrom->copy();
            $dateFrom = $dateTo->copy()->startOfDay();
            $dateTo = $temp->copy()->endOfDay();
        }

        $dateFromValue = $dateFrom->format('Y-m-d');
        $dateToValue = $dateTo->format('Y-m-d');

        // Kalau tanggal sama, label tampil 1 tanggal saja
        $periodLabel = $dateFrom->isSameDay($dateTo)
            ? $dateFrom->format('d M Y')
            : $dateFrom->format('d M Y') . ' - ' . $dateTo->format('d M Y');

        // Query dasar berdasarkan range tanggal
        $periodQuery = Book::whereBetween('booking_date', [
            $dateFromValue,
            $dateToValue
        ]);

        $totalBookings = (clone $periodQuery)->count();

        $totalSuccessBookings = (clone $periodQuery)
            ->where('payment_status', 'success')
            ->count();

        $totalPendingBookings = (clone $periodQuery)
            ->where('payment_status', 'pending')
            ->count();

        $totalChallengeBookings = (clone $periodQuery)
            ->where('payment_status', 'challenge')
            ->count();

        $totalFailedBookings = (clone $periodQuery)
            ->where('payment_status', 'failed')
            ->count();

        $periodRevenue = Book::with('court')
            ->where('payment_status', 'success')
            ->whereBetween('booking_date', [
                $dateFromValue,
                $dateToValue
            ])
            ->get()
            ->sum(fn ($book) => $book->court->price ?? 0);

        $totalMember = User::where('role', '!=', 'admin')->count();

        $totalCourts = Court::count();

        // Recent bookings sesuai range tanggal
        $books = Book::with(['court', 'user', 'schedule'])
            ->whereBetween('booking_date', [
                $dateFromValue,
                $dateToValue
            ])
            ->latest()
            ->paginate(5)
            ->withQueryString();

        // Range tanggal untuk chart
        $dateRange = collect(CarbonPeriod::create(
            $dateFrom->copy()->startOfDay(),
            $dateTo->copy()->startOfDay()
        ))->map(fn ($date) => $date->format('Y-m-d'));

        // Booking trend per hari
        $bookingRawData = Book::select(
                DB::raw('DATE(booking_date) as date'),
                DB::raw('count(*) as total')
            )
            ->whereBetween('booking_date', [
                $dateFromValue,
                $dateToValue
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $bookingTrend = $dateRange->map(fn ($date) => [
            'date' => $date,
            'total' => $bookingRawData[$date] ?? 0,
        ]);

        // Revenue trend per hari
        $revenueRawData = Book::with('court')
            ->where('payment_status', 'success')
            ->whereBetween('booking_date', [
                $dateFromValue,
                $dateToValue
            ])
            ->get()
            ->groupBy(fn ($book) => Carbon::parse($book->booking_date)->format('Y-m-d'))
            ->map(fn ($group) => $group->sum(fn ($book) => $book->court->price ?? 0));

        $revenueTrend = $dateRange->mapWithKeys(fn ($date) => [
            $date => $revenueRawData[$date] ?? 0,
        ]);

        // Status chart sesuai range
        $statusBreakdown = [
            'Success' => $totalSuccessBookings,
            'Pending' => $totalPendingBookings,
            'Challenge' => $totalChallengeBookings,
            'Failed' => $totalFailedBookings,
        ];

        // Top courts sesuai range dan hanya booking sukses
        $topCourts = Book::with('court')
            ->where('payment_status', 'success')
            ->whereBetween('booking_date', [
                $dateFromValue,
                $dateToValue
            ])
            ->get()
            ->groupBy('court_id')
            ->map(function ($group) {
                $court = $group->first()->court;

                return [
                    'name' => $court->name ?? 'Unknown Court',
                    'total_bookings' => $group->count(),
                    'total_revenue' => $group->sum(fn ($book) => $book->court->price ?? 0),
                ];
            })
            ->sortByDesc('total_bookings')
            ->take(5)
            ->values();

        return view('dashboard.index', compact(
            'dateFromValue',
            'dateToValue',
            'periodLabel',
            'totalBookings',
            'periodRevenue',
            'totalMember',
            'totalCourts',
            'totalSuccessBookings',
            'totalPendingBookings',
            'totalChallengeBookings',
            'totalFailedBookings',
            'books',
            'bookingTrend',
            'revenueTrend',
            'statusBreakdown',
            'topCourts'
        ));
    }
}
