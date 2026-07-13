<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MidtransController extends Controller
{

    public function callback(Request $request)
    {
        // Inisialisasi konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        // Ambil notifikasi
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        // Cari booking berdasarkan order_id
        $book = Book::where('order_id', $orderId)->first();

        if (!$book) {
            return response()->json(['message' => 'Order ID not found'], 404);
        }

        // Update status pembayaran berdasarkan status dari Midtrans
        if ($transaction === 'capture') {
            if ($type === 'credit_card') {
                if ($fraud === 'challenge') {
                    $book->payment_status = 'challenge';
                } else {
                    $book->payment_status = 'success';
                }
            }
        } elseif ($transaction === 'settlement') {
            $book->payment_status = 'success';
        } elseif ($transaction === 'pending') {
            $book->payment_status = 'pending';
        } elseif (in_array($transaction, ['deny', 'expire', 'cancel'])) {
            $book->payment_status = 'failed';
        }

        $book->save();

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
